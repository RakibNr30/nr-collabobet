<?php

namespace App\Http\Controllers\Portal;

use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::query()->withCount(['recommendations', 'notAttends'])->find(AuthUser::getId());
        $balance = Balance::query()->where('user_id', $user->id)->firstOrCreate(['user_id' => $user->id]);

        return view('portal.profile.index', compact('user', 'balance'));
    }


}
