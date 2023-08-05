<?php

namespace App\Http\Controllers\Portal;

use App\Constants\TransactionStatus;
use App\Constants\TransactionType;
use App\Constants\UserType;
use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = User::query()->find(auth()->user()->id);

        $statistics = new \stdClass();

        if (AuthUser::isAdmin()) {
            $statistics->total_user = User::query()->where('user_type', UserType::USER)->count();
            $statistics->total_transaction = Transaction::query()->where('type', TransactionType::OUT)->count();
            $statistics->total_accepted_transaction = Transaction::query()->where('type', TransactionType::OUT)->where('status', TransactionStatus::ACCEPTED)->count();
            $statistics->total_accepted_transaction_amount = Transaction::query()->where('type', TransactionType::OUT)->where('status', TransactionStatus::ACCEPTED)->sum('amount');
        }

        return view('portal.dashboard.index', compact('authUser', 'statistics'));
    }
}
