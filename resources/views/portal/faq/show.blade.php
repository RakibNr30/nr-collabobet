@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid- faq py-2">
        <div class="table-c row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Faq</h5>
                            </div>
                            <a href="{{ route('portal.faq.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-2 pb-2">
                        <div class="mx-4">
                            <p class="h6">{{ $faq->question }}</p>
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')

@endpush

