<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = User::query()->find(auth()->user()->id);

        return view('portal.dashboard.index', $authUser);
    }
}
