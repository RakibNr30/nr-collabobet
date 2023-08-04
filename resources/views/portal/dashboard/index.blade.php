@extends('layouts.user_type.auth')

@section('content')

    @if(\App\Helpers\AuthUser::isUser())
        @if(\App\Helpers\AuthUser::getProfileStatus() == \App\Constants\ProfileStatus::ACCOUNT_CREATED)
            <div class="container-fluid- dashboard">
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
                                <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">Submit and Next</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endif

        @if(in_array(\App\Helpers\AuthUser::getProfileStatus(), [App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED, \App\Constants\ProfileStatus::VERIFICATION_COMPLETED]))
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <p class="mb-1 pt-2 text-bold">Welcome {{ auth()->user()->full_name }}</p>

                                @if(!\App\Helpers\AuthUser::isVerificationRequested() && !\App\Constants\ProfileStatus::VERIFICATION_COMPLETED)
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{ route('portal.user-verification.edit') }}">
                                    Verify Identity
                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5 ms-auto text-center mt-3 mt-lg-0">
                            <div class="bg-gradient-primary border-radius-lg h-100">
                                <i class="fas fa-coins db-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif


@endsection
@push('dashboard')

@endpush

