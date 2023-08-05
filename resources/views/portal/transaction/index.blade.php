@extends('layouts.user_type.auth')

@section('content')
    @if(\App\Helpers\AuthUser::isUser())
        <div class="container-fluid- py-2">
            <div class="table-c row">
                <div class="col-12">
                    <div class="container-fluid- transaction py-4-">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <h6 class="mb-0">Request Transaction</h6>
                                    </div>
                                    <a href="{{ route('portal.dashboard.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                                </div>
                            </div>
                            <div class="card-body pt-4">
                                @if(empty($lastPendingTransaction))
                                    <form action="{{ route('portal.transaction.store') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="account_owner" class="form-control-label">Account Owner</label>
                                                    <div class="">
                                                        <input class="form-control @error('account_owner') border border-danger rounded-3 @enderror" value="{{ old('account_owner') }}" type="text" placeholder="Account Owner" id="account_owner" name="account_owner">
                                                        @error('account_owner')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="blz" class="form-control-label">BLZ</label>
                                                    <div class="">
                                                        <input class="form-control @error('blz') border border-danger rounded-3 @enderror" value="{{ old('blz') }}" type="text" placeholder="BLZ" id="blz" name="blz">
                                                        @error('blz')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="iban" class="form-control-label">IBAN</label>
                                                    <div class="">
                                                        <input class="form-control @error('iban') border border-danger rounded-3 @enderror" value="{{ old('iban') }}" type="text" placeholder="IBAN" id="iban" name="iban">
                                                        @error('iban')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="annotation" class="form-control-label">Annotation</label>
                                                    <div class="">
                                                        <textarea rows="6" class="form-control @error('annotation') border border-danger rounded-3 @enderror" type="text" placeholder="Annotation" id="annotation" name="annotation">{{ old('annotation') }}</textarea>
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

    <div class="container-fluid- faq py-2">
        <div class="table-c row">
            <div class="col-12">
                <div class="card mb-2 mx-2">
                    <div class="card-header pb-4">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Transactions</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-2 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        DateTime
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Amount
                                    </th>
                                    @if(\App\Helpers\AuthUser::isAdmin())
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            A/C owner
                                        </th>
                                    @endif
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        BLZ
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        IBAN
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    @if(\App\Helpers\AuthUser::isAdmin())
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transactions as $index => $transaction)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($transaction->created_at)->format('Y.m.d h:i A') ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transaction->amount ?? 0 }}</p>
                                        </td>
                                        @if(\App\Helpers\AuthUser::isAdmin())
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $transaction->account_owner ?? '-' }}</p>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transaction->blz ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transaction->iban ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ \App\Constants\TransactionStatus::getLabel($transaction->status ?? 0) ?? '-' }}</p>
                                        </td>
                                        @if(\App\Helpers\AuthUser::isAdmin())
                                            <td class="text-center">
                                                @if($transaction->status == \App\Constants\TransactionStatus::PENDING)
                                                    <a href="#" onclick="submit('acceptTransaction{{ $index }}')" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Accept">
                                                        <i class="fas fa-check text-info"></i>
                                                    </a>
                                                    <form id="acceptTransaction{{ $index }}" method="POST" action="{{ route('portal.transaction.update', [$transaction]) }}" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="{{ \App\Constants\TransactionStatus::ACCEPTED }}">
                                                    </form>
                                                    <a href="#" onclick="submit('declineTransaction{{ $index }}')" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Decline">
                                                        <i class="fas fa-times text-danger"></i>
                                                    </a>
                                                    <form id="declineTransaction{{ $index }}" method="POST" action="{{ route('portal.transaction.update', [$transaction]) }}" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="{{ \App\Constants\TransactionStatus::DECLINED }}">
                                                    </form>
                                                @else
                                                    <span style="font-size: 10px;font-weight: 600;">{{ $transaction->actioned_at ? \Carbon\Carbon::parse($transaction->actioned_at)->format('Y.m.d h:i A') : '-' }}</span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr class="">
                                        <td class="text-center" colspan="{{ \App\Helpers\AuthUser::isAdmin() ? 8 : 6 }}">No data found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $transactions->links('components.pagination') }}
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

