<?php

namespace App\Http\Controllers\Portal;

use App\Constants\ProfileStatus;
use App\Constants\UserType;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::query()->get();

        return view('portal.faq.index', compact('faqs'));
    }

    public function show(User $user)
    {
        return view('portal.user.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {

            DB::beginTransaction();

            $user->update($request->all());

            DB::commit();

            if ($user->profile_status == ProfileStatus::VERIFICATION_COMPLETED)
                session()->flash('success', 'Verification accepted successfully.');
            else
                session()->flash('success', 'Verification declined successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }
}
