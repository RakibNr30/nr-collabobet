@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card mt-8">
                            @if($errors->any())
                                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                        {{$errors->first()}}
                                    </span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                                    <span class="alert-text text-white">
                                        {{ session('success') }}
                                    </span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h4 class="mb-0">Forgot your password? Enter your mobile here</h4>
                            </div>
                            <div class="card-body">

                                <form action="/forgot-password" method="POST" role="form text-left">
                                    @csrf
                                    <div>
                                        <label for="mobile">Mobile</label>
                                        <div class="">
                                            <input id="mobile" name="mobile" type="text" class="form-control" placeholder="Mobile" aria-label="Mobile" aria-describedby="mobile-addon">
                                            @error('mobile')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Recover your password</button>
                                    </div>
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
