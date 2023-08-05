@extends('layouts.user_type.auth')

@section('content')

    <div class="container-fluid- verification py-4-">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h6 class="mb-0">Edit Faq</h6>
                    </div>
                    <a href="{{ route('portal.faq.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('portal.faq.update', [$faq]) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="question" class="form-control-label">Question</label>
                                <div class="">
                                    <input class="form-control @error('question') border border-danger rounded-3 @enderror" value="{{ old('question') ?? $faq->question }}" type="text" placeholder="Question" id="question" name="question">
                                    @error('question')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile" class="form-control-label">Answer</label>
                                <div class="">
                                    <input class="form-control @error('answer') border border-danger rounded-3 @enderror" value="{{ old('answer') ?? $faq->answer }}" type="text" placeholder="Answer" id="answer" name="answer">
                                    @error('answer')
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

@endsection

@push('dashboard')

@endpush

