@extends('layouts.member')

@section('title', 'My Membership')

@push('styles')
    <style>

        :root {
    --bg: #242027;
    --surface: #1B1820;
    --surface-light: #29232D;
    --border: #826a75;
    --text: #FFFFFF;
    --muted: #C2B9C8;

    --pink: #E86DB5;
    --pink-dark: #4B2945;

    --green: #63D99B;
    --green-bg: rgba(99, 217, 155, 0.12);

    --amber: #F2B84B;
    --amber-bg: rgba(242, 184, 75, 0.12);

    --violet: #A77BFF;
}
        .table-wrap {
            padding: 0;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 14px 18px;
            text-align: left;
            vertical-align: middle;
        }

        thead th {
            background: var(--surface-2);
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        tbody tr + tr td {
            border-top: 1px solid var(--border);
        }

        td.amount {
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        @media (max-width: 760px) {
            thead {
                display: none;
            }

            table,
            tbody,
            tr,
            td {
                display: block;
                width: 100%;
            }

            tbody tr {
                padding: 8px 0;
            }

            tbody tr + tr {
                border-top: 1px solid var(--border);
            }

            tbody tr + tr td {
                border-top: 0;
            }

            td {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                padding: 6px 18px;
            }

            td::before {
                content: attr(data-label);
                color: var(--muted);
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>My Membership</h1>
        <p>Your membership details and payment history.</p>
    </div>

    <section class="section" style="margin-top: 0;">
        <div class="section-head">
            <h2>Membership Details</h2>
        </div>

        <div class="card">
            <dl class="details">
                <div>
                    <dt>Membership No.</dt>
                    <dd>{{ $member->membership_number }}</dd>
                </div>

                <div>
                    <dt>Status</dt>
                    <dd>@include('member.partials.membership-status', ['status' => $member->status])</dd>
                </div>

                <div>
                    <dt>Start Date</dt>
                    <dd>{{ $currentMembership?->membership_start_date?->format('M d, Y') ?? '—' }}</dd>
                </div>

                <div>
                    <dt>End Date</dt>
                    <dd>{{ $currentMembership?->membership_end_date?->format('M d, Y') ?? '—' }}</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <h2>Personal Information</h2>
        </div>

        <div class="card">
            <dl class="details">
                <div>
                    <dt>Name</dt>
                    <dd>{{ $member->name }}</dd>
                </div>

                <div>
                    <dt>Email</dt>
                    <dd>{{ $member->email }}</dd>
                </div>

                <div>
                    <dt>Phone Number</dt>
                    <dd>{{ $member->phone_number ?: '—' }}</dd>
                </div>

                <div>
                    <dt>Address</dt>
                    <dd>{{ $member->address ?: '—' }}</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <h2>Transaction History</h2>
        </div>

        @if ($transactions->isEmpty())
            <div class="card empty">No transactions recorded yet.</div>
        @else
            <div class="card table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction No.</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Transaction Status</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transactions as $transaction)
                            @php
                                $amountPaid = (float) $transaction->payments->sum('amount');

                                if (
                                    in_array($transaction->status, ['paid', 'approved'], true)
                                    || ($amountPaid > 0 && $amountPaid >= (float) $transaction->amount)
                                ) {
                                    [$paymentLabel, $paymentBadge] = ['Paid', 'badge-success'];
                                } elseif ($amountPaid > 0) {
                                    [$paymentLabel, $paymentBadge] = ['Partially Paid', 'badge-info'];
                                } else {
                                    [$paymentLabel, $paymentBadge] = ['Unpaid', 'badge-warning'];
                                }

                                $transactionBadge = match ($transaction->status) {
                                    'approved' => 'badge-success',
                                    'paid' => 'badge-info',
                                    'pending' => 'badge-warning',
                                    'rejected', 'cancelled' => 'badge-danger',
                                    default => '',
                                };
                            @endphp

                            <tr>
                                <td data-label="Transaction No.">{{ $transaction->transaction_number }}</td>
                                <td data-label="Date">{{ $transaction->transaction_date?->format('M d, Y') ?? '—' }}</td>
                                <td data-label="Type">{{ ucwords(str_replace('_', ' ', $transaction->transaction_type)) }}</td>
                                <td data-label="Amount" class="amount">₱{{ number_format((float) $transaction->amount, 2) }}</td>
                                <td data-label="Transaction Status">
                                    <span class="badge {{ $transactionBadge }}">{{ ucfirst($transaction->status) }}</span>
                                </td>
                                <td data-label="Payment Status">
                                    <span class="badge {{ $paymentBadge }}">{{ $paymentLabel }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
