<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = User::query()->find(auth()->user()->id);

        return view('portal.dashboard.index', $authUser);
    }
}
