@extends('layouts.user_type.guest')

@section('content')

    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            @if(!empty($verification))
                                <div class="card mt-8">
                                    <div class="card-header pb-0 text-left bg-transparent">
                                        <p class="mb-0">Submit your code<br></p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left" method="POST" action="{{ route('register.store') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Code" name="code" id="code" aria-label="Code" aria-describedby="code-addon" value="{{ old('code') }}">
                                                @error('code')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-gradient-info w-100 mt-2 mb-0">Submit</button>
                                            </div>
                                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="card mt-8">
                                    <div class="card-header pb-0 text-left bg-transparent">
                                        <h3 class="font-weight-bolder text-info text-gradient">Welcome</h3>
                                        <p class="mb-0">Profile creating using your friend's affiliate code.<br></p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left" method="POST" action="{{ route('register.store') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Mobile" name="mobile" id="mobile" aria-label="Mobile" aria-describedby="mobile-addon" value="{{ old('mobile') }}">
                                                @error('mobile')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Your friend's affiliate code" name="refer_affiliate_code" id="refer_affiliate_code" aria-label="Refer Affiliate Code" aria-describedby="refer-affiliate-code-addon" value="{{ old('refer_affiliate_code') }}">
                                                @error('refer_affiliate_code')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-gradient-info w-100 mt-2 mb-0">Next</button>
                                            </div>
                                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

