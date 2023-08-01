@extends('layouts.user_type.guest')

@section('content')

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Create a new acount<br></p>
                                </div>
                                <div class="card-body">
                                    <form role="form text-left" method="POST" action="/register">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Email" name="mobile" id="mobile" aria-label="Email" aria-describedby="mobile-addon" value="{{ old('mobile') ?? $mobile }}" readonly>
                                            @error('mobile')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                                            @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Affiliate Code" name="affiliate_code" id="affiliate_code" aria-label="Affiliate Code" aria-describedby="affiliate_code" value="{{ old('affiliate_code') }}">
                                            @error('affiliate_code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Refer Affiliate Code" name="refer_affiliate_code" id="refer_affiliate_code" aria-label="Refer Affiliate Code" aria-describedby="refer_affiliate_code" value="{{ old('refer_affiliate_code') }}">
                                            @error('refer_affiliate_code')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                                            @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" name="is_agreement_accepted" id="flexCheckDefault" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                            @error('is_agreement_accepted')
                                            <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign up</button>
                                        </div>
                                        <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

