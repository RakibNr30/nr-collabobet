<?php

namespace App\Http\Controllers\Portal;

use App\Constants\UserType;
use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::query()->find(AuthUser::getId());

        return view('portal.profile.index', compact('user'));
    }
}
