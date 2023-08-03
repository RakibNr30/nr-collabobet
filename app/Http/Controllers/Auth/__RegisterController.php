<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SmsVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class __RegisterController extends Controller
{
    public function mobileVerification()
    {
        $verification = self::getMobileVerification();

        return view('session.mobile_verification', compact('verification'));
    }

    public function postMobileVerification(Request $request)
    {
        $verification = self::getMobileVerification();

        if (!empty($verification)) {
            $request->validate([
                'code' => ['required', 'max:50'],
            ]);
        } else {
            $request->validate([
                'mobile' => ['required', 'min:6', 'max:50', Rule::unique('users', 'mobile')],
            ]);
        }

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

                    return redirect()->back();
                }

                DB::beginTransaction();

                $smsVerification->delete();

                DB::commit();

                session()->forget('verification_id');

                session()->flash('success', 'Your mobile verification has been successful.');

                return redirect()->route('register.create')->with([
                    'is_verified' => true,
                    'mobile' => $smsVerification->mobile,
                ]);
            }
            else
            {
                $code = rand(100000, 999999);
                $verification_id = Str::uuid()->toString();

                DB::beginTransaction();

                SmsVerification::query()->updateOrCreate([
                    'mobile' => $request->mobile
                ], [
                    'mobile' => $request->mobile,
                    'code' => $code,
                    'expired_at' => Carbon::now()->addMinutes(2),
                    'verification_id' => $verification_id,
                ]);

                DB::commit();

                session()->put('verification_id', $verification_id);

                session()->flash('success', 'A verification code has been sent to your mobile. Please enter this code for further process.');
            }

        } catch (\Exception $exception) {

            DB::rollBack();

        }

        return redirect()->back();
    }

    public function create()
    {
        if ((session()->has('is_verified') && session()->get('is_verified')) || any()->err) {
            $mobile = session()->get('mobile');

            session()->put([
                'is_verified' => session()->get('is_verified'),
                'mobile' => $mobile,
            ]);

            return view('session.register', compact('mobile'));
        }

        session()->forget(['is_verified', 'mobile']);

        return redirect()->route('register.mobile-verification.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'mobile' => ['required', 'min:6', 'max:50', Rule::unique('users', 'mobile')],
            'name' => ['required', 'max:50'],
            'affiliate_code' => ['required', 'min:6', 'max:50', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('users', 'username')],
            'refer_affiliate_code' => ['required'],
            'password' => ['required', 'min:6', 'max:20'],
            'is_agreement_accepted' => ['accepted']
        ]);

        try {

            $attributes['password'] = bcrypt($attributes['password']);

            DB::beginTransaction();

            $user = User::create($attributes);

            DB::commit();

            session()->flash('success', 'Your account has been created.');

            Auth::login($user);

        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return redirect()->route('portal.dashboard.index');
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
