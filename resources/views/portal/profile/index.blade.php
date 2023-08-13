@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid- py-2">
        <div class="table-c row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">{{ $user->full_name }}</h5>
                            </div>
                            <a href="{{ route('portal.dashboard.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-3 mt-3">
                                <thead class="text-lg-start">
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Your Affiliate Code
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->affiliate_code ?? '-'}}</p>
                                    </td>
                                </tr>
                                {{--<tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Your Friend's Affiliate Code
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->refer_affiliate_code ?? '-'}}</p>
                                    </td>
                                </tr>--}}
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Member Since
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Collabobet Balance
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $balance->amount ?? 0 }}$</p>
                                    </td>
                                </tr>
                                {{--<tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mobile
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->mobile ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date of Birth
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($user->dob)->format('Y.m.d') ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Verification
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        @if(\App\Helpers\AuthUser::isVerified())
                                            <p class="text-info text-xs font-weight-bold mb-0">Verified</p>
                                        @else
                                            <p class="text-danger text-xs font-weight-bold mb-0">Pending</p>
                                        @endif
                                    </td>
                                </tr>--}}
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Recommendations
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->recommendations_count ?? 0 }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Not Attended Yet
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->not_attends_count ?? 0 }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Donations
                                        <p class="text-xs text-primary font-weight-bold" style="font-size: 6px !important;">
                                            We donate $10 for every participant.<br>Thats the amount we donated thank you!
                                        </p>
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->refer_reward_amount ?? 0 }}$</p>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(\App\Helpers\AuthUser::isVerified())
            <div class="table-c row mb-5">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mx-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="numbers">
                                        <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[$400] Participant – Participate in Collabobet</p>
                                        <span style="font-size: 10px;">For your participation you just need to verify on your account</span>
                                        <h5 class="font-weight-bolder mt-2">
                                            <span class="text-primary text-xs font-weight-bolder">{{ $rewards[\App\Constants\RewardType::PARTICIPANT]['claimed_rewards'] ?? 0 }} / {{ \App\Constants\RewardType::getMax(\App\Constants\RewardType::PARTICIPANT) }}</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    @if($rewards[\App\Constants\RewardType::PARTICIPANT]['rewardable'] ?? 0)
                                        <a href="#" onclick="submit('reward-participant')">
                                            <span class="badge badge-info">Get Reward ({{ $rewards[\App\Constants\RewardType::PARTICIPANT]['rewardable'] ?? 0 }})</span>
                                        </a>
                                        <form id="reward-participant" method="POST" action="{{ route('portal.profile-reward.store') }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="type" value="{{ \App\Constants\RewardType::PARTICIPANT }}">
                                            <input type="hidden" name="rewardable" value="{{ $rewards[\App\Constants\RewardType::PARTICIPANT]['rewardable'] ?? 0 }}">
                                            <input type="hidden" name="rewardable_amount" value="{{ $rewards[\App\Constants\RewardType::PARTICIPANT]['rewardable_amount'] ?? 0 }}">
                                        </form>
                                    @else
                                        <span class="badge badge-disable">Get Reward ({{ $rewards[\App\Constants\RewardType::PARTICIPANT]['rewardable'] ?? 0 }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mx-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="numbers">
                                        <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[$200] Recommendation – Recommend Collabobet to your friends</p>
                                        <span style="font-size: 10px;">Your friend need to sign up on collabobet and verify his account</span>
                                        <h5 class="font-weight-bolder mt-2">
                                            <span class="text-primary text-xs font-weight-bolder">{{ $rewards[\App\Constants\RewardType::RECOMMENDATION]['claimed_rewards'] ?? 0 }} / {{ \App\Constants\RewardType::getMax(\App\Constants\RewardType::RECOMMENDATION) }}</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    @if($rewards[\App\Constants\RewardType::RECOMMENDATION]['rewardable'] ?? 0)
                                        <a href="#" onclick="submit('reward-recommendation')">
                                            <span class="badge badge-info">Get Reward ({{ $rewards[\App\Constants\RewardType::RECOMMENDATION]['rewardable'] ?? 0 }})</span>
                                        </a>
                                        <form id="reward-recommendation" method="POST" action="{{ route('portal.profile-reward.store') }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="type" value="{{ \App\Constants\RewardType::RECOMMENDATION }}">
                                            <input type="hidden" name="rewardable" value="{{ $rewards[\App\Constants\RewardType::RECOMMENDATION]['rewardable'] ?? 0 }}">
                                            <input type="hidden" name="rewardable_amount" value="{{ $rewards[\App\Constants\RewardType::RECOMMENDATION]['rewardable_amount'] ?? 0 }}">
                                        </form>
                                    @else
                                        <span class="badge badge-disable">Get Reward ({{ $rewards[\App\Constants\RewardType::RECOMMENDATION]['rewardable'] ?? 0 }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mx-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="numbers">
                                        <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[$100] Benefactor – Reach Donations</p>
                                        <span style="font-size: 10px;">WirWe donate $10 for each participant to charity.</span>
                                        <h5 class="font-weight-bolder mt-2">
                                            <span class="text-primary text-xs font-weight-bolder">{{ $rewards[\App\Constants\RewardType::BENEFACTOR]['claimed_rewards'] ?? 0 }} / {{ \App\Constants\RewardType::getMax(\App\Constants\RewardType::BENEFACTOR) }}</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    @if($rewards[\App\Constants\RewardType::BENEFACTOR]['rewardable'] ?? 0)
                                        <a href="#" onclick="submit('reward-benefactor')">
                                            <span class="badge badge-info">Get Reward ({{ $rewards[\App\Constants\RewardType::BENEFACTOR]['rewardable'] ?? 0 }})</span>
                                        </a>
                                        <form id="reward-benefactor" method="POST" action="{{ route('portal.profile-reward.store') }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="type" value="{{ \App\Constants\RewardType::BENEFACTOR }}">
                                            <input type="hidden" name="rewardable" value="{{ $rewards[\App\Constants\RewardType::BENEFACTOR]['rewardable'] ?? 0 }}">
                                            <input type="hidden" name="rewardable_amount" value="{{ $rewards[\App\Constants\RewardType::BENEFACTOR]['rewardable_amount'] ?? 0 }}">
                                        </form>
                                    @else
                                        <span class="badge badge-disable">Get Reward ({{ $rewards[\App\Constants\RewardType::BENEFACTOR]['rewardable'] ?? 0 }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card mx-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="numbers">
                                        <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[$500] Genius of Persuasion – Recommend 20 people</p>
                                        <span style="font-size: 10px;">All your recommendations need to sign up on collabobet and verify their account</span>
                                        <h5 class="font-weight-bolder mt-2">
                                            <span class="text-primary text-xs font-weight-bolder">{{ $rewards[\App\Constants\RewardType::GENIUS]['claimed_rewards'] ?? 0 }} / {{ \App\Constants\RewardType::getMax(\App\Constants\RewardType::GENIUS) }}</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    @if($rewards[\App\Constants\RewardType::GENIUS]['rewardable'] ?? 0)
                                        <a href="#" onclick="submit('reward-genius')">
                                            <span class="badge badge-info">Get Reward ({{ $rewards[\App\Constants\RewardType::GENIUS]['rewardable'] ?? 0 }})</span>
                                        </a>
                                        <form id="reward-genius" method="POST" action="{{ route('portal.profile-reward.store') }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="type" value="{{ \App\Constants\RewardType::GENIUS }}">
                                            <input type="hidden" name="rewardable" value="{{ $rewards[\App\Constants\RewardType::GENIUS]['rewardable'] ?? 0 }}">
                                            <input type="hidden" name="rewardable_amount" value="{{ $rewards[\App\Constants\RewardType::GENIUS]['rewardable_amount'] ?? 0 }}">
                                        </form>
                                    @else
                                        <span class="badge badge-disable">Get Reward ({{ $rewards[\App\Constants\RewardType::GENIUS]['rewardable'] ?? 0 }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('dashboard')
    <script>
        function submit(formId) {
            document.getElementById(formId).submit();
        }
    </script>
@endpush

