<?php

namespace App\Services;

use App\Constants\RewardType;
use App\Models\User;

class ReferralService
{
    public static function calculateAndDistributeRewards(User $user, $rewardAmount): void
    {
        // Traverse the referral tree recursively
        $referrals = User::query()->where('affiliate_code', $user->refer_affiliate_code)->get();

        // Distribute rewards to referred users
        foreach ($referrals as $referral) {
            $referral->refer_reward += 1;
            $referral->refer_reward_amount += $rewardAmount;
            $referral->save();

            // here need recursion
            RewardService::update($referral->id, RewardType::BENEFACTOR);

            // Recursively distribute rewards to the next level of referrals
            self::calculateAndDistributeRewards($referral, $rewardAmount);
        }
    }
}
