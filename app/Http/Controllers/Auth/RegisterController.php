<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ProfileStatus;
use App\Constants\UserType;
use App\Helpers\SmsManager;
use App\Http\Controllers\Controller;
use App\Models\SmsVerification;
use App\Models\User;
use App\Rules\UsMobileNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{

    public function create()
    {
        $verification = self::getMobileVerification();

        return view('session.register', compact('verification'));
    }

    public function store(Request $request)
    {
        $verification = self::getMobileVerification();

        $rules = [];

        if (!empty($verification)) {
            $rules['code'] = ['required', 'max:50'];
        } else {
            $user = User::query()->where('mobile', $request->mobile)->whereNotNull('mobile_verified_at')->first();
            if (!empty($user)) {
                $rules['mobile'] = ['required', new UsMobileNumber()];
            } else {
                $rules['refer_affiliate_code'] = ['required', 'max:50'];
                $rules['mobile'] = ['required',  new UsMobileNumber(), Rule::unique('users', 'mobile')];
            }
        }

        $request->validate($rules);

        try {

            if (!empty($verification))
            {
                $smsVerification = SmsVerification::query()
                    ->where('mobile', $verification->mobile)
                    ->where('code', $request->code)
                    ->where('expired_at', '>', Carbon::now())
                    ->first();

                if (empty($smsVerification))
                {
                    session()->flash('error', 'You entered a wrong or expired verification code.');

                    return redirect()->back()->withInput($request->all());
                }


                DB::beginTransaction();

                $user = User::updateOrCreate([
                    'mobile' => $smsVerification->mobile,
                ], [
                    'mobile' => $smsVerification->mobile,
                    'user_type' => UserType::USER,
                    'refer_affiliate_code' => $smsVerification->refer_affiliate_code,
                    'profile_status' => ProfileStatus::ACCOUNT_CREATED,
                    'mobile_verified_at' => Carbon::now(),
                ]);

                $smsVerification->delete();

                Auth::login($user);

                DB::commit();

                session()->forget('verification_id');

                session()->flash('success', 'Your profile has been created.');

                return redirect()->route('portal.dashboard.index');
            }
            else
            {
                $user = User::query()->where('mobile', $request->mobile)->whereNotNull('affiliate_code')->whereNotNull('password')->first();

                if (!empty($user)) {
                    session()->flash('error', 'You already have an account. Please login via mobile and password.');

                    return redirect()->route('login');
                }

                $refer = User::query()->where('affiliate_code', $request->refer_affiliate_code)->first();

                if (empty($refer))
                {
                    session()->flash('error', 'You entered a wrong affiliate code.');

                    return redirect()->back()->withInput($request->all());
                }

                $code = rand(100000, 999999);
                $verification_id = Str::uuid()->toString();

                DB::beginTransaction();

                SmsVerification::query()->updateOrCreate([
                    'mobile' => $request->mobile
                ], [
                    'mobile' => $request->mobile,
                    'refer_affiliate_code' => $refer->affiliate_code,
                    'code' => $code,
                    'expired_at' => Carbon::now()->addMinutes(2),
                    'verification_id' => $verification_id,
                ]);

                if (SmsManager::isSendAble()) {
                    SmsManager::sendSms($request->mobile, "COLLABOBET: Your verification code is: {$code}. You can use this code for next 2 minutes.");
                }

                DB::commit();

                session()->put('verification_id', $verification_id);

                session()->flash('success', 'A verification code has been sent to your mobile. Please enter this code for further process.');
            }

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back()->withInput($request->all());
    }

    private function getMobileVerification()
    {
        if (session()->has('verification_id')) {
            return SmsVerification::query()
                ->where('verification_id', session()->get('verification_id'))
                ->where('expired_at', '>', Carbon::now())
                ->first();
        }

        return null;
    }
}
