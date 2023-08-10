<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ProfileStatus;
use App\Helpers\SmsManager;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Rules\UsMobileNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetController extends Controller
{
    public function create()
    {
        return view('session/reset-password/sendToken');
    }

    public function sendToken(Request $request)
    {
        $request->validate(['mobile' => 'required', new UsMobileNumber()]);

        $user = User::query()->where('mobile', $request->mobile)->where('profile_status', '>=', ProfileStatus::PERSONAL_DETAILS_CREATED)->first();

        if (empty($user)) {
            session()->flash('error', 'User not found.');
            return redirect()->back()->withInput($request->all());
        }

        $code = rand(100000, 999999);

        try {
            DB::beginTransaction();

            PasswordReset::query()->updateOrCreate([
                'mobile' => $request->mobile
            ], [
                'mobile' => $request->mobile,
                'token' => $code,
            ]);

            if (SmsManager::isSendAble()) {
                SmsManager::sendSms($request->mobile, "COLLABOBET: Your verification code is: {$code}. You can use this code for reset password.");
            }

            session()->flash('success', 'A verification code has been sent to your mobile. Please enter this code for reset password.');

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            session()->flash('error', 'Something went wrong.');

            return redirect()->back()->withInput($request->all());
        }

        return redirect()->route('password.reset', ['mobile' => $request->mobile]);
    }

    public function resetPass($mobile)
    {
        return view('session/reset-password/resetPassword', compact('mobile'));
    }
}
