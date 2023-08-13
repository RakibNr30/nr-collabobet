@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid- py-2">
        <div class="table-c row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Transaction Details</h5>
                            </div>
                            <a href="{{ route('portal.transaction.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-3 mt-3">
                                <thead class="text-lg-start">
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        DATETIME
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Amount
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $transaction->amount ?? 0}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        BTC-Wallet
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ $transaction->btc_wallet ?? '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ \App\Constants\TransactionStatus::getLabel($transaction->status ?? 0) ?? '-' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Accept/Decline Time
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder">
                                        <p class="text-xs font-weight-bold mb-0">{{ !empty($transaction->actioned_at) ? \Carbon\Carbon::parse($transaction->actioned_at)->format('M d, Y') : '-'}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Annotation
                                    </th>
                                    <td class="text-left text-xxs font-weight-bolder" style="white-space: normal">
                                        <p class="text-xs font-weight-bold mb-0">{{ $transaction->annotation ?? '-'}}</p>
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
@endsection

@push('dashboard')
@endpush

