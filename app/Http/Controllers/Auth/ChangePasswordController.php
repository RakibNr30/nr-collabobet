<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ProfileStatus;
use App\Helpers\SmsManager;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'mobile' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $passwordReset = PasswordReset::query()
            ->where('mobile', $request->mobile)
            ->where('token', $request->code)
            ->first();

        $user = User::query()
            ->where('mobile', $request->mobile)
            ->where('profile_status', '>=', ProfileStatus::PERSONAL_DETAILS_CREATED)
            ->first();

        if (empty($user) || empty($passwordReset)) {
            session()->flash('error', 'Your provided information is not match with our records.');
            return redirect()->back()->withInput($request->all());
        }

        try {

            DB::beginTransaction();

            $user->update([
                'password' => bcrypt($request->password)
            ]);

            PasswordReset::query()->where('mobile', $request->mobile)->delete();

            if (SmsManager::isSendAble()) {
                SmsManager::sendSms($user->mobile, "COLLABOBET: Your password has been reset successfully.");
            }

            DB::commit();

            session()->flash('success', 'Password reset successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');

            return redirect()->back()->withInput($request->all());
        }

        return redirect()->route('login');

    }
}
