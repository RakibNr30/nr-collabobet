@extends('layouts.user_type.auth')

@section('content')
    @if(\App\Helpers\AuthUser::isAdmin())
        <div class="container-fluid- py-2">
            <div class="table-c row">
                <div class="col-12">
                    <div class="container-fluid- transaction py-4-">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h6 class="mb-0">Give Special Money</h6>
                                    </div>
                                    <a href="{{ route('portal.transaction.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                                </div>
                            </div>
                            <div class="card-body pt-4">
                                @if(empty($lastPendingTransaction))
                                    <form action="{{ route('portal.transaction-special.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="user_id" class="form-control-label">User (Only Verified Users)</label>
                                                    <div class="">
                                                        <select class="form-control @error('user_id') border border-danger rounded-3 @enderror" id="user_id" name="user_id">
                                                            <option value="">Select</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->full_name_username }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('user_id')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="amount" class="form-control-label">Amount</label>
                                                    <div class="">
                                                        <input class="form-control @error('amount') border border-danger rounded-3 @enderror" value="{{ old('amount') }}" type="number" min="1" step="any" placeholder="Amount" id="amount" name="amount">
                                                        @error('amount')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="annotation" class="form-control-label">Explanation / Annotation</label>
                                                    <div class="">
                                                        <textarea rows="6" class="form-control @error('annotation') border border-danger rounded-3 @enderror" type="text" placeholder="Explanation / Annotation" id="annotation" name="annotation">{{ old('annotation') }}</textarea>
                                                        @error('annotation')
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
                                @else
                                    <span class="text-primary">You can not make a request because you have already a pending request.</span>
                                @endif
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

