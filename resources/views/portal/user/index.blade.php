@extends('layouts.user_type.auth')

@section('content')
        <div class="container-fluid- user py-2">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-2 mx-2">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">Users</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            First Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Last Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mobile
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date of Birth
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Affiliate Code
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Refer Affiliate Code
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Verification
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $index => $user)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->first_name ?? '-' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->last_name ?? '-' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->mobile ?? '-' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($user->dob)->format('Y.m.d') ?? '-' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->affiliate_code ?? '-' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $user->refer_affiliate_code ?? '-' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ \App\Constants\ProfileStatus::getLabel($user->profile_status ?? 0) }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if($user->profile_status == \App\Constants\ProfileStatus::VERIFICATION_COMPLETED)
                                                    <p class="text-info text-xs font-weight-bold mb-0">Verified</p>
                                                @else
                                                    <p class="text-danger text-xs font-weight-bold mb-0">Pending</p>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('portal.user.show', [$user]) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="View User">
                                                    <i class="fas fa-eye text-secondary"></i>
                                                </a>
                                                @if($user->is_verification_requested)
                                                    <a href="#" onclick="submit('acceptVerificationForm{{ $index }}')" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Accept User">
                                                        <i class="fas fa-check text-info"></i>
                                                    </a>
                                                    <form id="acceptVerificationForm{{ $index }}" method="POST" action="{{ route('portal.user.update', [$user]) }}" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="profile_status" value="{{ \App\Constants\ProfileStatus::VERIFICATION_COMPLETED }}">
                                                        <input type="hidden" name="is_verification_requested" value="{{ 0 }}">
                                                    </form>
                                                @endif
                                                @if($user->is_verification_requested)
                                                    <a href="#" onclick="submit('declineVerificationForm{{ $index }}')" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Decline User">
                                                        <i class="fas fa-times text-danger"></i>
                                                    </a>
                                                    <form id="declineVerificationForm{{ $index }}" method="POST" action="{{ route('portal.user.update', [$user]) }}" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="profile_status" value="{{ \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED }}">
                                                        <input type="hidden" name="is_verification_requested" value="{{ 0 }}">
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="">
                                            <td class="text-center" colspan="10">No data found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $users->links('components.pagination') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('dashboard')
    <script>
        function submit(formId) {
            document.getElementById(formId).submit();
        }
    </script>
@endpush

