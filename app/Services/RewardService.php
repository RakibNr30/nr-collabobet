<?php

namespace App\Services;

use App\Constants\RewardType;
use App\Constants\TransactionStatus;
use App\Constants\TransactionType;
use App\Helpers\AuthUser;
use App\Models\Balance;
use App\Models\Reward;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

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

        if ($rewardType == RewardType::BENEFACTOR) {
            $user = User::query()->find($userId);
            $total_rewards = intval($user->refer_reward_amount / 100);
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

    public static function getRewards($userId, $rewardType): void
    {
        $rewardable = self::rewardAble($userId, $rewardType);

        if ($rewardable[0]) {
            $reward = Reward::query()
                ->where('user_id', $userId)
                ->where('type', $rewardType)
                ->first();

            $reward->update([
                'claimed_rewards' => $reward->claimed_rewards + $rewardable[0]
            ]);

            $balance = Balance::query()->where('user_id', $userId)->firstOrCreate(['user_id' => $userId]);

            $balance->update([
                'amount' => $balance->amount + $rewardable[1],
            ]);

            $user = User::query()->find(AuthUser::getId());

            Transaction::query()->create([
                'type' => TransactionType::IN,
                'balance_id' => $balance->id,
                'amount' => $rewardable[1],
                'account_owner' => $user->full_name,
                'uuid' => Str::uuid()->toString(),
                'user_id' => $userId,
                'status' => TransactionStatus::ACCEPTED,
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

    public static function rewardAble($userId, $rewardType): array
    {
        $reward = Reward::query()
            ->where('user_id', $userId)
            ->where('type', $rewardType)
            ->first();

        if (empty($reward)) {
            return [0, 0];
        }

        return [
            $reward->total_rewards - $reward->claimed_rewards,
            ($reward->total_rewards - $reward->claimed_rewards) * $reward->amount
        ];
    }
}
