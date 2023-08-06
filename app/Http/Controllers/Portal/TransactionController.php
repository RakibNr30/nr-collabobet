<?php

namespace App\Http\Controllers\Portal;

use App\Constants\TransactionStatus;
use App\Constants\TransactionType;
use App\Helpers\AuthUser;
use App\Helpers\SmsManager;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $lastPendingTransaction = null;

        if (AuthUser::isUser()) {
            $transactions = Transaction::query()
                ->where('type', TransactionType::OUT)
                ->where('user_id', AuthUser::getId())
                ->orderBy('status')
                ->orderBy('created_at')
                ->orderBy('actioned_at')
                ->paginate(10);

            $lastPendingTransaction = Transaction::query()
                ->where('type', TransactionType::OUT)
                ->where('user_id', AuthUser::getId())
                ->where('status', TransactionStatus::PENDING)
                ->first();
        } else {
            $transactions = Transaction::query()
                ->where('type', TransactionType::OUT)
                ->orderBy('status')
                ->orderBy('created_at')
                ->orderBy('actioned_at')
                ->paginate(10);
        }

        return view('portal.transaction.index', compact('transactions', 'lastPendingTransaction'));
    }

    public function store(Request $request)
    {
        $rules = [
            'amount' => 'numeric|required|min:1|max:999999',
            'account_owner' => 'required|max:100',
            'blz' => 'required|max:100',
            'iban' => 'required|max:100',
            'annotation' => 'required|max:1000',
        ];

        $request->validate($rules);

        $lastPendingTransaction = Transaction::query()
            ->where('type', TransactionType::OUT)
            ->where('user_id', AuthUser::getId())
            ->where('status', TransactionStatus::PENDING)
            ->first();

        if (!empty($lastPendingTransaction)) {
            session()->flash('error', 'You already have a pending request..');

            return redirect()->back();
        }

        $data = $request->all();

        try {

            $balance = Balance::query()->where('user_id', AuthUser::getId())->firstOrCreate(['user_id' => AuthUser::getId()]);

            if ($balance->amount < $data['amount']) {
                session()->flash('error', 'Your requested amount should be not exceed your current balance.');

                return redirect()->back()->withInput($request->all());
            }

            $data['type'] = TransactionType::OUT;
            $data['balance_id'] = $balance->id;
            $data['uuid'] = Str::uuid()->toString();
            $data['user_id'] = AuthUser::getId();
            $data['status'] = TransactionStatus::PENDING;

            DB::beginTransaction();

            Transaction::query()->create($data);

            DB::commit();

            session()->flash('success', 'Transaction request successful.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');

            return redirect()->back()->withInput($request->all());
        }

        return redirect()->route('portal.transaction.index');
    }


    public function update(Request $request, Transaction $transaction)
    {
        $rules = [
            'status' => 'required',
        ];

        $request->validate($rules);

        $data = $request->all();

        $transactionAmount = $transaction->amount;

        try {

            $data['actioned_at'] = Carbon::now();

            DB::beginTransaction();

            if ($data['status'] == TransactionStatus::ACCEPTED) {

                $balance = Balance::query()->where('user_id', $transaction->user_id)->firstOrCreate(['user_id' => $transaction->user_id]);

                if ($balance->amount < $transaction->amount) {
                    session()->flash('error', 'Requested amount should be not exceed user\'s current balance.');
                    DB::rollBack();
                    return redirect()->back();
                }

                $balance->update(['amount' => $balance->amount - $transactionAmount]);

                $transaction->update($data);

                $user = User::query()->findOrFail($transaction->user_id);

                if (SmsManager::isSendAble()) {
                    SmsManager::sendSms($user->mobile, "COLLABOBET: Congratulations! Your transaction amount {$transactionAmount}€ has been accepted.");
                }

                session()->flash('success', 'Transaction request accepted successful.');
            }
            else
            {
                $transaction->update($data);

                $user = User::query()->findOrFail($transaction->user_id);

                if (SmsManager::isSendAble()) {
                    SmsManager::sendSms($user->mobile, "COLLABOBET: We regret to inform you that your transaction amount {$transactionAmount}€ declined at this time.");
                }

                session()->flash('success', 'Transaction request declined successful.');
            }

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');

            return redirect()->back();
        }

        return redirect()->route('portal.transaction.index');
    }
}
