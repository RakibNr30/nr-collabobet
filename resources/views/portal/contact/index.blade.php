@extends('layouts.user_type.auth')

@section('content')

    @if(\App\Helpers\AuthUser::isAdmin())
    <div class="container-fluid- verification py-4-">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Contact</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('portal.contact.update', [$contact]) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">E-mail</label>
                                <div class="">
                                    <input class="form-control @error('email') border border-danger rounded-3 @enderror" value="{{ old('email') ?? $contact->email }}" type="email" placeholder="E-mail" id="email" name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile" class="form-control-label">Mobile</label>
                                <div class="">
                                    <input class="form-control @error('mobile') border border-danger rounded-3 @enderror" value="{{ old('mobile') ?? $contact->mobile }}" type="text" placeholder="Mobile" id="mobile" name="mobile">
                                    @error('mobile')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fax" class="form-control-label">Fax</label>
                                <div class="">
                                    <input class="form-control @error('fax') border border-danger rounded-3 @enderror" value="{{ old('fax') ?? $contact->fax }}" type="text" placeholder="Fax" id="fax" name="fax">
                                    @error('fax')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-control-label">Address</label>
                                <div class="">
                                    <input class="form-control @error('address') border border-danger rounded-3 @enderror" value="{{ old('address') ?? $contact->address }}" type="text" placeholder="Address" id="address" name="address">
                                    @error('address')
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
                                    <h5 class="mb-0">Contact Us</h5>
                                </div>
                                <a href="{{ route('portal.dashboard.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-3 mt-3">
                                    <thead class="text-lg-start">
                                    <tr>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            E-mail
                                        </th>
                                        <td class="text-left text-xxs font-weight-bolder">
                                            <p class="text-xs font-weight-bold mb-0">{{ $contact->email ?? '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mobile
                                        </th>
                                        <td class="text-left text-xxs font-weight-bolder">
                                            <p class="text-xs font-weight-bold mb-0">{{ $contact->mobile ?? '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fax
                                        </th>
                                        <td class="text-left text-xxs font-weight-bolder">
                                            <p class="text-xs font-weight-bold mb-0">{{ $contact->fax ?? '-'}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Address
                                        </th>
                                        <td class="text-left text-xxs font-weight-bolder">
                                            <p class="text-xs font-weight-bold mb-0">{{ $contact->address ?? '-' }}</p>
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
    @endif

@endsection

@push('dashboard')

@endpush

