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
                                        <p class="text-xs font-weight-bold mb-0">{{ $balance->amount ?? 0 }}€</p>
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
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->donations ?? 0 }}€</p>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-c row mb-5">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card mx-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[€400] Participant – Participate in Collabobet</p>
                                    <span style="font-size: 10px;">For your participation you just need to verify on your account</span>
                                    <h5 class="font-weight-bolder mt-2">
                                        <span class="text-primary text-xs font-weight-bolder">0 / 1</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <a href="#">
                                    <span class="badge badge-info">Get Reward</span>
                                </a>
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
                                    <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[€200] Recommendation – Recommend Collabobet to your friends</p>
                                    <span style="font-size: 10px;">Your friend need to sign up on collabobet and verify his account</span>
                                    <h5 class="font-weight-bolder mt-2">
                                        <span class="text-primary text-xs font-weight-bolder">0 / infinity</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <a href="#">
                                    <span class="badge badge-info">Get Reward</span>
                                </a>
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
                                    <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[€100] Benefactor – Reach Donations</p>
                                    <span style="font-size: 10px;">WirWe donate $10 for each participant to charity.</span>
                                    <h5 class="font-weight-bolder mt-2">
                                        <span class="text-primary text-xs font-weight-bolder">€0 / €300</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <a href="#">
                                    <span class="badge badge-info">Get Reward</span>
                                </a>
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
                                    <p class="text-xs text-primary mb-0 text-capitalize font-weight-bold">[€500] Genius of Persuasion – Recommend 20 people</p>
                                    <span style="font-size: 10px;">All your recommendations need to sign up on collabobet and verify their account</span>
                                    <h5 class="font-weight-bolder mt-2">
                                        <span class="text-primary text-xs font-weight-bolder">0 / 50</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <a href="#">
                                    <span class="badge badge-info">Get Reward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('dashboard')

@endpush

