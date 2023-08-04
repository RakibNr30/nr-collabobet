@extends('layouts.user_type.auth')

@section('content')

    <div class="container-fluid- change-password py-4-">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Change Password</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('portal.user-change-password.update') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="old_password" class="form-control-label">Old Password</label>
                                <div class="">
                                    <input class="form-control @error('old_password') border border-danger rounded-3 @enderror" value="{{ old('old_password') }}" type="password" placeholder="Old Password" id="old_password" name="old_password">
                                    @error('old_password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_password" class="form-control-label">New Password</label>
                                <div class="">
                                    <input class="form-control @error('new_password') border border-danger rounded-3 @enderror" value="{{ old('new_password') }}" type="password" placeholder="New Password" id="new_password" name="new_password">
                                    @error('new_password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_password_confirmation" class="form-control-label">Re-enter New Password</label>
                                <div class="">
                                    <input class="form-control @error('new_password_confirmation') border border-danger rounded-3 @enderror" value="{{ old('new_password_confirmation') }}" type="password" placeholder="Re-enter New Password" id="new_password_confirmation" name="new_password_confirmation">
                                    @error('new_password_confirmation')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push('dashboard')

@endpush

