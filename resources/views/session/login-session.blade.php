@extends('layouts.user_type.guest')

@section('content')

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card mt-8">

                                @include('components.alert')

                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Create a new acount<br></p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="/session">
                                        @csrf
                                        <label>Mobile</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">{{ config('core.country_code') }}</span>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                   placeholder="Mobile" value="{{ old('mobile') }}" aria-label="Mobile"
                                                   aria-describedby="mobile-addon">
                                        </div>
                                        @error('mobile')
                                        <p class="text-danger text-xs mt-0">{{ $message }}</p>
                                        @enderror
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                   placeholder="Password" aria-label="Password"
                                                   aria-describedby="password-addon">
                                            @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <small class="text-muted">Forgot you password? Reset your password
                                        <a href="/login/forgot-password"
                                           class="text-info text-gradient font-weight-bold">here</a>
                                    </small>
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('register.create') }}"
                                           class="text-info text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
