@extends('layouts.user_type.auth')

@section('content')

    @if(\App\Helpers\AuthUser::isAdmin())
    <div class="container-fluid- verification py-4-">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Terms and Conditions</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('portal.terms-and-conditions.update', [$termsAndConditions]) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="details" class="form-control-label">Details</label>
                                <div class="">
                                    <textarea rows="10" class="form-control @error('details') border border-danger rounded-3 @enderror" placeholder="Details" id="details" name="details">{{ old('details') ?? $termsAndConditions->details }}</textarea>
                                    @error('details')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endif

    @if(\App\Helpers\AuthUser::isUser())
        <div class="container-fluid- py-2">
            <div class="table-c row">
                <div class="col-12">
                    <div class="card mb-4 mx-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">Terms and Conditions</h5>
                                </div>
                                <a href="{{ route('portal.dashboard.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="mx-4 py-4 text-sm text-justify">
                                {{ $termsAndConditions->details ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('dashboard')

@endpush

