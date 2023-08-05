<?php

namespace App\Services;

use App\Constants\RewardType;
use App\Models\Reward;
use App\Models\User;

class RewardService
{
    public static function update($userId, $rewardType): void
    {
        $reward = Reward::query()
            ->where('user_id', $userId)
            ->where('type', $rewardType)
            ->first();

        $total_rewards = 1;

        if (!empty($reward)) {
            $total_rewards = $reward->total_rewards + 1;
        }

        if ($rewardType == RewardType::GENIUS) {
            $user = User::query()->withCount(['recommendations'])->find($userId);
            $total_rewards = intval($user->recommendations_count / 20);
        }

        if (self::isEligible($userId, $rewardType))
        {
            Reward::query()->updateOrCreate([
                'user_id' => $userId,
                'type' => $rewardType
            ], [
                'user_id' => $userId,
                'type' => $rewardType,
                'amount' => RewardType::getAmount($rewardType),
                'is_available' => true,
                'total_rewards' => $total_rewards,
            ]);
        }
    }

    public static function isEligible($userId, $rewardType): bool
    {
        $reward = Reward::query()
            ->where('user_id', $userId)
            ->where('type', $rewardType)
            ->first();

        if (empty($reward)) {
            return true;
        }

        if ($rewardType == RewardType::PARTICIPANT) {
            if ($reward->total_rewards < RewardType::getMax(RewardType::PARTICIPANT))
                return true;
        }

        if ($rewardType == RewardType::RECOMMENDATION) {
            if ($reward->total_rewards < RewardType::getMax(RewardType::RECOMMENDATION))
                return true;
        }

        if ($rewardType == RewardType::BENEFACTOR) {
            if ($reward->total_rewards < RewardType::getMax(RewardType::BENEFACTOR))
                return true;
        }

        if ($rewardType == RewardType::GENIUS) {
            if ($reward->total_rewards < RewardType::getMax(RewardType::GENIUS))
                return true;
        }

        return false;
    }

    public static function isRewardable($userId, $rewardType): bool
    {
        $reward = Reward::query()
            ->where('user_id', $userId)
            ->where('type', $rewardType)
            ->first();

        if (empty($reward)) {
            return false;
        }

        if ($rewardType == RewardType::PARTICIPANT)
        {
            if ($reward->count == 1)
                return true;
        }

        if ($rewardType == RewardType::RECOMMENDATION)
        {
            if ($reward->count > 0 && $reward->is_available)
                return true;
        }

        if ($rewardType == RewardType::BENEFACTOR)
        {
            //
        }

        if ($rewardType == RewardType::GENIUS)
        {
            if ($reward->total_rewards >= 1 && $reward->count <=50 && $reward->is_available)
                return true;
        }

        return false;
    }
}
