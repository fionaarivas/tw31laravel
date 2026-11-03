<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction Details</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f8faf9;
            color: #26332f;
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "SF Pro Display",
                "SF Pro Text",
                "Segoe UI",
                Helvetica,
                Arial,
                sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .content {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
            padding: 45px 35px 70px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .subtitle {
            color: #71807a;
            margin-top: 9px;
            font-size: 15px;
        }

        .back-button {
            background: white;
            color: #337a4b;
            border: 1px solid #cfe0d7;
            padding: 11px 17px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
        }

        .back-button:hover {
            background: #eef7f1;
        }

        .details-card {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, 0.08);
        }

        .alert {
            max-width: 900px;
            margin: 0 auto 20px;
            padding: 14px 17px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-success {
            color: #337a4b;
            background: #e2f4e4;
        }

        .alert-error {
            color: #b83e64;
            background: #fff0f4;
        }

        .section-title {
            color: #337a4b;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .reference-number {
            color: #337a4b;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-box {
            background: #f8fbf9;
            border: 1px solid #e1ebe5;
            border-radius: 10px;
            padding: 17px;
        }

        .detail-label {
            color: #71807a;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .detail-value {
            color: #26332f;
            font-size: 16px;
            font-weight: 600;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .amount {
            color: #337a4b;
            font-size: 20px;
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status.pending {
            background: #fff0d8;
            color: #a8631b;
        }

        .status.paid,
        .status.approved {
            background: #e2f4e4;
            color: #337a4b;
        }

        .status.expired,
        .status.cancelled {
            background: #fff0f4;
            color: #b83e64;
        }

        .notes-box {
            background: #fff5f8;
            border-left: 4px solid #e875a8;
            border-radius: 9px;
            padding: 17px;
            margin-top: 20px;
        }

        .notes-title {
            color: #b83e64;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .notes-text {
            color: #52635b;
            line-height: 1.6;
            white-space: pre-line;
        }

        .payment-section {
            margin-top: 30px;
        }

        .payment-section h3 {
            color: #337a4b;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-table th,
        .payment-table td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #e7eeea;
            font-size: 14px;
        }

        .payment-table th {
            color: #71807a;
            font-size: 12px;
            text-transform: uppercase;
        }

        .no-payment {
            color: #71807a;
            background: #f8fbf9;
            padding: 15px;
            border-radius: 9px;
            font-size: 14px;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            border: none;
            border-radius: 9px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-button {
            background: #fff0d8;
            color: #a8631b;
        }

        .edit-button:hover {
            background: #ffe5bd;
        }

        .approve-button {
            background: #e2f4e4;
            color: #337a4b;
        }

        .approve-button:hover {
            background: #ccebd2;
        }

        .back-bottom-button {
            background: #eef3f0;
            color: #52635b;
        }

        .back-bottom-button:hover {
            background: #dfe9e4;
        }

        @media (max-width: 700px) {
            .content {
                padding: 25px 18px;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .details-card {
                padding: 22px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .payment-table {
                display: block;
                overflow-x: auto;
            }

            .button-row {
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
            }

            .button-row form {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<main class="content">

    <div class="top-section">
        <div>
            <h1>Transaction Details</h1>

            <p class="subtitle">
                View complete membership transaction information.
            </p>
        </div>

        <a
            href="{{ route('transactions.index') }}"
            class="back-button"
        >
            ← Back to Transactions
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="details-card">

        <div class="section-title">
            Transaction Information
        </div>

        <div class="reference-number">
            {{ $transaction->transaction_number }}
        </div>

        <div class="details-grid">

            <div class="detail-box">
                <div class="detail-label">Member</div>

                <div class="detail-value">
                    {{ $transaction->member?->name ?? 'N/A' }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Membership Number</div>

                <div class="detail-value">
                    {{ $transaction->member?->membership_number ?? 'N/A' }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Transaction Type</div>

                <div class="detail-value">
                    {{ ucfirst($transaction->transaction_type) }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Membership Level</div>

                <div class="detail-value">
                    {{ $transaction->membershipLevel?->name ?? 'N/A' }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Amount</div>

                <div class="amount">
                    ₱{{ number_format($transaction->amount, 2) }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Status</div>

                <span class="status {{ $transaction->status }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>

            <div class="detail-box">
                <div class="detail-label">Transaction Date</div>

                <div class="detail-value">
                    {{ $transaction->transaction_date?->format('F d, Y') }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Membership Start Date</div>

                <div class="detail-value">
                    {{ $transaction->membership_start_date?->format('F d, Y') ?? 'Not set' }}
                </div>
            </div>

            <div class="detail-box full-width">
                <div class="detail-label">Membership End Date</div>

                <div class="detail-value">
                    {{ $transaction->membership_end_date?->format('F d, Y') ?? 'Not set' }}
                </div>
            </div>

        </div>

        <div class="notes-box">
            <div class="notes-title">
                Notes
            </div>

            <div class="notes-text">
                {{ $transaction->notes ?: 'No notes provided.' }}
            </div>
        </div>

        <div class="payment-section">
            <h3>Payment Details</h3>

            @forelse ($transaction->payments as $payment)
                <table class="payment-table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $payment->payment_reference }}</td>
                            <td>₱{{ number_format($payment->amount, 2) }}</td>
                            <td>
                                {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                            </td>
                            <td>
                                {{ $payment->payment_date?->format('F d, Y') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @empty
                <div class="no-payment">
                    No payment has been recorded for this transaction yet.
                </div>
            @endforelse
        </div>

        <div class="button-row">

            <a
                href="{{ route('transactions.index') }}"
                class="button back-bottom-button"
            >
                Back
            </a>

            <a
                href="{{ route('transactions.edit', $transaction) }}"
                class="button edit-button"
            >
                Edit Transaction
            </a>

            @if ($transaction->status === 'paid')
                <form
                    action="{{ route('transactions.approve', $transaction) }}"
                    method="POST"
                    onsubmit="return confirm('Approve this paid transaction?')"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="button approve-button"
                    >
                        Approve Transaction
                    </button>
                </form>
            @endif

        </div>

    </div>

</main>

</body>
</html>