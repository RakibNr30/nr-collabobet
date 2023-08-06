<?php

namespace App\Http\Controllers\Portal;

use App\Constants\ProfileStatus;
use App\Constants\RewardType;
use App\Constants\UserType;
use App\Helpers\SmsManager;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ReferralService;
use App\Services\RewardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('user_type', UserType::USER)->paginate(20);

        return view('portal.user.index', compact('users'));
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

            if ($user->profile_status == ProfileStatus::VERIFICATION_COMPLETED) {
                // reward for own
                RewardService::update($user->id, RewardType::PARTICIPANT);

                // reward for refer
                $refer = User::query()->withCount(['recommendations'])->where('affiliate_code', $user->refer_affiliate_code)->first();

                RewardService::update($refer->id, RewardType::RECOMMENDATION);

                // refer tree reward
                ReferralService::calculateAndDistributeRewards($user, 10);

                RewardService::update($refer->id, RewardType::GENIUS);

                if (SmsManager::isSendAble()) {
                    SmsManager::sendSms($user->mobile, "COLLABOBET: Congratulations! your profile has been successfully verified.");
                }

                session()->flash('success', 'Verification accepted successfully.');
            }
            else {
                if (SmsManager::isSendAble()) {
                    SmsManager::sendSms($user->mobile, "COLLABOBET: We regret to inform you that your profile cannot be verified at this time.");
                }

                session()->flash('success', 'Verification declined successfully.');
            }

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }
}
