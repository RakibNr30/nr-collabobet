@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid- py-2">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">{{ $user->full_name }}</h5>
                            </div>
                            <a href="{{ route('portal.dashboard.index') }}" class="btn bg-gradient-dark btn-sm mb-0" type="button">Back</a>
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
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Your Friend's Affiliate Code
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->refer_affiliate_code ?? '-'}}</p>
                                    </td>
                                </tr>
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
                                        <p class="text-xs font-weight-bold mb-0">{{ 0 }}</p>
                                    </td>
                                </tr>
                                <tr>
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
                                        @if($user->profile_status == \App\Constants\ProfileStatus::VERIFICATION_COMPLETED)
                                            <p class="text-info text-xs font-weight-bold mb-0">Verified</p>
                                        @else
                                            <p class="text-danger text-xs font-weight-bold mb-0">Pending</p>
                                        @endif
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')

@endpush

