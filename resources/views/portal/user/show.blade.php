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
                            <a href="{{ route('portal.user.index') }}" class="btn bg-gradient-dark btn-sm mb-0" type="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-3 mt-3">
                                <thead class="text-lg-end">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mobile
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->mobile ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date of Birth
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($user->dob)->format('Y.m.d') ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Affiliate Code
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->affiliate_code ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Refer Affiliate Code
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->refer_affiliate_code ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ \App\Constants\ProfileStatus::getLabel($user->profile_status ?? 0) }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Verification
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        @if($user->profile_status == \App\Constants\ProfileStatus::VERIFICATION_COMPLETED)
                                            <p class="text-info text-xs font-weight-bold mb-0">Verified</p>
                                        @else
                                            <p class="text-danger text-xs font-weight-bold mb-0">Pending</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Sate-Issued photo ID – FRONT
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <a href="{{ $user->photo_id_front->file_url ?? '' }}" download>
                                            <img src="{{ $user->photo_id_front->file_url ?? '' }}" width="100px" alt="" />
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Sate-Issued photo ID – BACK
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <a href="{{ $user->photo_id_back->file_url ?? '' }}" download>
                                            <img src="{{ $user->photo_id_back->file_url ?? '' }}" width="100px" alt="" />
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Selfie with Front of State-Issued photo ID
                                    </th>
                                    <td class="text-center text-xxs font-weight-bolder">
                                        <a href="{{ $user->photo_id_selfie->file_url ?? '' }}" download>
                                            <img src="{{ $user->photo_id_selfie->file_url ?? '' }}" width="100px" alt="" />
                                        </a>
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

