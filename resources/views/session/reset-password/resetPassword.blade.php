@extends('layouts.user_type.guest')

@section('content')

<div class="page-header section-height-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card mt-8">
                    @if($errors->any())
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                                {{$errors->first()}}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif

                    @include('components.alert')

                    <div class="card-header pb-0 text-left bg-transparent">
                        <h4 class="mb-0">Change password</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" action="/reset-password" method="POST">
                            @csrf
                            <div>
                                <div>
                                    <label for="code">Mobile</label>
                                    <div class="">
                                        <input id="mobile" name="mobile" type="text" value="{{ old('mobile') ?? $mobile }}" class="form-control" placeholder="Mobile" aria-label="Mobile" aria-describedby="mobile-addon" readonly>
                                        @error('mobile')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <label for="code">Verification Code</label>
                                <div class="">
                                    <input id="code" name="code" type="text" class="form-control" value="{{ old('code') }}" placeholder="Verification Code" aria-label="Verification Code" aria-describedby="code-addon">
                                    @error('code')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="password">New Password</label>
                                <div class="">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="">
                                    <input id="password-confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Password-confirmation" aria-label="Password-confirmation" aria-describedby="Password-addon">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Recover your password</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Remembered the password? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
