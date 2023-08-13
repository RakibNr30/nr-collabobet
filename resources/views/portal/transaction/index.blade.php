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
                                            <div class="col-md-12">
                                                <p class="text-sm text-primary">You can just top up your Venmo, Cashapp or PayPal by giving us your BTC Wallet Adress and switch it into Dollar yourself on these Apps.</p>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="btc_wallet" class="form-control-label">BTC-Wallet</label>
                                                    <div class="">
                                                        <input class="form-control @error('btc_wallet') border border-danger rounded-3 @enderror" value="{{ old('btc_wallet') }}" type="text" placeholder="BTC-Wallet" id="btc_wallet" name="btc_wallet">
                                                        @error('btc_wallet')
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
                                <h5 class="mb-0">Transactions (Debit)</h5>
                            </div>
                            @if(\App\Helpers\AuthUser::isAdmin())
                                <a href="{{ route('portal.transaction.create') }}" class="btn bg-gradient-primary btn-xs text-xs mb-0" type="button" style="padding: 10px;">Give Special Money</a>
                            @endif
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        BTC-Wallet
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transactions->where('type', \App\Constants\TransactionType::OUT) as $index => $transaction)
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
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $transaction->btc_wallet ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ \App\Constants\TransactionStatus::getLabel($transaction->status ?? 0) ?? '-' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('portal.transaction.show', [$transaction]) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="View">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                            @if(\App\Helpers\AuthUser::isAdmin())
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
                                                @endif
                                           @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="">
                                        <td class="text-center text-xs" colspan="{{ 6 }}">No data found.</td>
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
                <div class="card mb-2 mx-2">
                    <div class="card-header pb-4">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Transactions (Credit)</h5>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transactions->where('type', \App\Constants\TransactionType::IN) as $index => $transaction)
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
                                        <td class="text-center">
                                            <a href="{{ route('portal.transaction.show', [$transaction]) }}" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="View">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="">
                                        <td class="text-center text-xs" colspan="{{ 6 }}">No data found.</td>
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

