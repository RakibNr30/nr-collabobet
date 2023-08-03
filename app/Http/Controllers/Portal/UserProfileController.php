<?php

namespace App\Http\Controllers\Portal;

use App\Constants\ProfileStatus;
use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function postPersonalDetails(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'dob' => ['required', 'max:50'],
            'affiliate_code' => ['required', 'min:6', 'max:50', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('users', 'affiliate_code')],
            'password' => ['required', 'min:6', 'max:50', 'confirmed'],
        ]);

        try {

            DB::beginTransaction();

            User::query()->where('id', AuthUser::getId())->update([
                'first_name'    => $request->first_name,
                'last_name'    => $request->last_name,
                'dob' => $request->dob,
                'affiliate_code' => $request->affiliate_code,
                'profile_status' => ProfileStatus::PERSONAL_DETAILS_CREATED,
                'password'     => bcrypt($request->password),
            ]);

            DB::commit();

            session()->flash('success', 'Personal details updated successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Personal details can not be updated.');
        }

        return redirect()->route('portal.dashboard.index');
    }

    public function postVerification(Request $request)
    {
        $request->validate([
            'photo_id_front' => ['required', 'mimes:jpg,jpeg,png', 'max: 2048'],
            'photo_id_back' => ['required', 'mimes:jpg,jpeg,png', 'max: 2048'],
            'photo_id_selfie' => ['required', 'mimes:jpg,jpeg,png', 'max: 2048'],
            'ssn' => ['required', 'size:9'],
            'is_tc_accepted' => ['accepted']
        ]);

        try {

            DB::beginTransaction();

            User::query()->where('id', AuthUser::getId())->update([
                'is_verification_requested'    => true,
                'ssn'    => $request->ssn,
                'is_tc_accepted'    => $request->is_tc_accepted,
            ]);

            $user = User::query()->find(AuthUser::getId());

            $user->uploadFiles();

            DB::commit();

            session()->flash('success', 'Documents for verification is submitted successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Documents for verification can not be submitted.');
        }

        return redirect()->route('portal.dashboard.index');
    }
}
