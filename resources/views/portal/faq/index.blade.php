@extends('layouts.user_type.auth')

@section('content')
        @if(\App\Helpers\AuthUser::isAdmin())
            <div class="container-fluid- faq py-2">
                <div class="table-c row">
                    <div class="col-12">
                        <div class="card mb-2 mx-2">
                            <div class="card-header pb-4">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h5 class="mb-0">Faqs</h5>
                                    </div>
                                    <a href="{{ route('portal.faq.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Faq</a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-4 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Question
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($faqs as $index => $faq)
                                            <tr>
                                                <td class="ps-4">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $faq->question ?? '-' }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('portal.faq.show', [$faq]) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="View">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                    <a href="{{ route('portal.faq.edit', [$faq]) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="fas fa-pencil-alt text-info"></i>
                                                    </a>
                                                    <a href="#" onclick="submit('delete{{ $index }}')" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                        <i class="fas fa-trash text-primary"></i>
                                                    </a>
                                                    <form id="delete{{ $index }}" method="POST" action="{{ route('portal.faq.destroy', [$faq]) }}" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="">
                                                <td class="text-center" colspan="4">No data found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    {{ $faqs->links('components.pagination') }}
                                </div>

                            </div>
                        </div>
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
                                        <h5 class="mb-0">Faqs</h5>
                                    </div>
                                    <a href="{{ route('portal.dashboard.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-3 mt-3">
                                        <thead class="text-lg-start">
                                        @forelse($faqs as $index => $faq)
                                            <tr>
                                                <th class="text-left text-secondary text-xxs font-weight-bolder" style="white-space: unset">
                                                    {{ $faq->question ?? '-' }}
                                                    <p class="text-left text-dark text-xxs font-weight-bolder">
                                                        {{ $faq->answer ?? '-' }}
                                                    </p>
                                                </th>
                                            </tr>
                                        @empty

                                        @endforelse
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
    <script>
        function submit(formId) {
            document.getElementById(formId).submit();
        }
    </script>
@endpush

