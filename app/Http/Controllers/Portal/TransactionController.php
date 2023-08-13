<?php

namespace App\Http\Controllers\Portal;

use App\Constants\ProfileStatus;
use App\Constants\TransactionStatus;
use App\Constants\TransactionType;
use App\Constants\UserType;
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
                ->orderBy('status')
                ->orderBy('created_at')
                ->orderBy('actioned_at')
                ->paginate(10);
        }

        return view('portal.transaction.index', compact('transactions', 'lastPendingTransaction'));
    }

    public function create()
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        $users = User::query()
            ->select(['id', 'first_name', 'last_name', 'affiliate_code'])
            ->where('user_type', UserType::USER)
            ->where('profile_status', ProfileStatus::VERIFICATION_COMPLETED)
            ->get();

        return view('portal.transaction.create', compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'amount' => 'numeric|required|min:1|max:999999',
            'btc_wallet' => 'required|max:255',
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

    public function show(Transaction $transaction)
    {
        return view('portal.transaction.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

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
                    SmsManager::sendSms($user->mobile, "COLLABOBET: Congratulations! Your transaction amount {$transactionAmount}$ has been accepted.");
                }

                session()->flash('success', 'Transaction request accepted successful.');
            }
            else
            {
                $transaction->update($data);

                $user = User::query()->findOrFail($transaction->user_id);

                if (SmsManager::isSendAble()) {
                    SmsManager::sendSms($user->mobile, "COLLABOBET: We regret to inform you that your transaction amount {$transactionAmount}$ declined at this time.");
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

    public function storeSpecial(Request $request)
    {
        if (!AuthUser::isAdmin()) {
            abort(404);
        }

        $rules = [
            'user_id' => 'required',
            'amount' => 'required|numeric|min:1|max:999999',
            'annotation' => 'required|max:1000',
        ];

        $request->validate($rules);

        $data = $request->all();

        try {

            DB::beginTransaction();

            $balance = Balance::query()->where('user_id', $data['user_id'])->first();

            if (empty($balance)) {
                $balance = Balance::query()->create([
                    'user_id' => $data['user_id'],
                    'uuid' => Str::uuid()->toString(),
                    'amount' => 0
                ]);
            }

            $balance->update([
                'amount' => $balance->amount + $data['amount'],
            ]);

            $data['type'] = TransactionType::IN;
            $data['balance_id'] = $balance->id;
            $data['uuid'] = Str::uuid()->toString();
            $data['user_id'] = $request->user_id;
            $data['status'] = TransactionStatus::ACCEPTED;

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
}
