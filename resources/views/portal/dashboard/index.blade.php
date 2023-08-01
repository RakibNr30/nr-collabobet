@extends('layouts.user_type.auth')

@section('content')

    @if(\App\Helpers\AuthUser::isUser())
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="progress-wrapper w-100">
                        <div class="progress-info">
                            <div class="progress-percentage">
                                <span class="text-xs font-weight-bold">{{ \App\Helpers\AuthUser::getProfileProgress() }}%</span>
                            </div>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-gradient-info w-{{ \App\Helpers\AuthUser::getProfileProgress() }}" role="progressbar" aria-valuenow="{{ \App\Helpers\AuthUser::getProfileProgress() }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px; margin-top: 0;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Progress #01</p>
                                        <h5 class="font-weight-bolder {{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::ACCOUNT_CREATED ? 'text-primary' : '' }} mb-0">
                                            Account Created
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::ACCOUNT_CREATED ? 'primary' : 'dark' }} shadow text-center border-radius-md">
                                        <i class="fa fa-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::ACCOUNT_CREATED ? 'check' : 'times' }} text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Progress #02</p>
                                        <h5 class="font-weight-bolder {{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED ? 'text-primary' : '' }} mb-0">
                                            Personal Details Created
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED ? 'primary' : 'dark' }} shadow text-center border-radius-md">
                                        <i class="fa fa-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED ? 'check' : 'times' }}" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Progress #03</p>
                                        <h5 class="font-weight-bolder {{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::VERIFICATION_COMPLETED ? 'text-primary' : '' }} mb-0">
                                            Verification Completed
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::VERIFICATION_COMPLETED ? 'primary' : 'dark' }} shadow text-center border-radius-md">
                                        <i class="fa fa-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::VERIFICATION_COMPLETED ? 'check' : 'times' }}" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(\App\Helpers\AuthUser::getProfileStatus() == \App\Constants\ProfileStatus::ACCOUNT_CREATED)
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Personal Details</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('portal.user-personal-details.update') }}" method="POST" role="form text-left">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="form-control-label">First Name</label>
                                        <div class="">
                                            <input class="form-control @error('first_name') border border-danger rounded-3 @enderror" value="{{ old('first_name') }}" type="text" placeholder="First name" id="first_name" name="first_name">
                                            @error('first_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="form-control-label">Last Name</label>
                                        <div class="">
                                            <input class="form-control @error('last_name') border border-danger rounded-3 @enderror" value="{{ old('last_name') }}" type="text" placeholder="First name" id="last_name" name="last_name">
                                            @error('last_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob" class="form-control-label">Date of Birth</label>
                                        <div class="">
                                            <input class="form-control @error('dob') border border-danger rounded-3 @enderror" value="{{ old('dob') }}" type="date" placeholder="Date of birth" id="dob" name="dob">
                                            @error('dob')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="affiliate_code" class="form-control-label">Your Own Affiliate Code</label>
                                        <div class="">
                                            <input class="form-control @error('affiliate_code') border border-danger rounded-3 @enderror" value="{{ old('affiliate_code') }}" type="text" placeholder="Your own affiliate code" id="affiliate_code" name="affiliate_code">
                                            @error('affiliate_code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password</label>
                                        <div class="">
                                            <input class="form-control @error('password') border border-danger rounded-3 @enderror" type="password" placeholder="Password" id="password" name="password">
                                            @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-control-label">Re-enter Password</label>
                                        <div class="">
                                            <input class="form-control @error('password_confirmation') border border-danger rounded-3 @enderror" type="password" placeholder="Re-enter password" id="password_confirmation" name="password_confirmation">
                                            @error('password_confirmation')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Submit and Next</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endif

        @if(\App\Helpers\AuthUser::getProfileStatus() == \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED)
            @if(!\App\Helpers\AuthUser::isVerificationRequested())
                <div class="container-fluid py-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Verification</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <form action="{{ route('portal.user-verification.update') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="photo_id_front" class="form-control-label">Sate-Issued photo ID – FRONT</label>
                                            <div class="">
                                                <input class="form-control @error('photo_id_front') border border-danger rounded-3 @enderror" value="{{ old('photo_id_front') }}" type="file" placeholder="Sate-issued photo ID – front" id="photo_id_front" name="photo_id_front">
                                                @error('photo_id_front')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="photo_id_back" class="form-control-label">Sate-Issued photo ID – BACK</label>
                                            <div class="">
                                                <input class="form-control @error('photo_id_back') border border-danger rounded-3 @enderror" value="{{ old('photo_id_back') }}" type="file" placeholder="Sate-issued photo ID – back" id="photo_id_back" name="photo_id_back">
                                                @error('photo_id_back')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="photo_id_selfie" class="form-control-label">Selfie with Front of State-Issued photo ID</label>
                                            <div class="">
                                                <input class="form-control @error('photo_id_selfie') border border-danger rounded-3 @enderror" value="{{ old('photo_id_selfie') }}" type="file" placeholder="Selfie with front of state-issued photo ID" id="photo_id_selfie" name="photo_id_selfie">
                                                @error('photo_id_selfie')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ssn" class="form-control-label">Last 9 digit of SSN Number</label>
                                            <div class="">
                                                <input class="form-control @error('ssn') border border-danger rounded-3 @enderror" value="{{ old('ssn') }}" type="text" placeholder="Last 9 digit of SSN number" id="ssn" name="ssn">
                                                @error('ssn')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" name="is_tc_accepted" id="flexCheckDefault" value="{{ 1 }}" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I confirm my acceptance of the attached <a href="javascript:;" class="text-dark font-weight-bolder">terms and conditions</a>
                                            </label>
                                            @error('is_tc_accepted')
                                            <p class="text-danger text-xs mt-2">First, agree to the terms and conditions, then try to verify again.</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Verify & Next</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @else
                <div class="container-fluid py-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Hi!</h6>
                        </div>
                        <div class="card-body p-3">
                            <span class="text-primary">Verification in progress! Give us a little time to review the uploaded documents. You‘ll get a message from us asap!</span>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if(\App\Helpers\AuthUser::getProfileStatus() == \App\Constants\ProfileStatus::VERIFICATION_COMPLETED)
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Hi!</h6>
                    </div>
                    <div class="card-body p-3">
                        <span class="text-primary">
                            Thank you for your verification!<br>
                            We waste no time and get to work right away<br>
                            &#128512;<br>
                            You are welcome to collect your reward in your profile and have it cashed out to your
                            Venmo, Cashapp, PayPal or any other BTC Wallet.<br>
                            We wish you a lot of fun with your money and would be very happy about
                            recommendations.<br>
                            Just make sure that your friends use your affiliate-code while signing up<br>
                        </span>
                    </div>
                </div>
            </div>
        @endif
    @endif

@endsection
@push('dashboard')
@endpush

