<?php

namespace App\Http\Controllers\Portal;

use App\Helpers\AuthUser;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Reward;
use App\Models\User;
use App\Services\RewardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::query()->withCount(['recommendations', 'notAttends'])->find(AuthUser::getId());
        $balance = Balance::query()->where('user_id', $user->id)->firstOrCreate(['user_id' => $user->id]);

        $rewards = Reward::query()
            ->where('user_id', AuthUser::getId())
            ->get()->mapWithKeys(function ($reward) {
                return [
                    $reward->type => [
                        'amount' => $reward->amount,
                        'total_rewards' => $reward->total_rewards,
                        'claimed_rewards' => $reward->claimed_rewards,
                        'rewardable' => $reward->total_rewards - $reward->claimed_rewards,
                        'rewardable_amount' => ($reward->total_rewards - $reward->claimed_rewards) * $reward->amount,
                    ]
                ];
            });

        return view('portal.profile.index', compact('user', 'balance', 'rewards'));
    }

    public function postRewards(Request $request)
    {
        $rules = [
            'type' => 'required',
            'rewardable' => 'required|numeric|min:1',
            'rewardable_amount' => 'required|numeric|min:1',
        ];

        $request->validate($rules);

        $data = $request->all();

        try {

            DB::beginTransaction();

            RewardService::getRewards(AuthUser::getId(), $data['type']);

            session()->flash('success', 'Rewarded €' . $data['rewardable_amount'] . ' is successful.');

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();

            session()->flash('error', 'Something went wrong.');
        }

        return redirect()->back();
    }
}
