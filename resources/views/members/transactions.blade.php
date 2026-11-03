<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction History</title>

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
        }

        .content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 45px 35px 70px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
        }

        .subtitle {
            color: #71807a;
            margin-top: 9px;
        }

        .back-button {
            padding: 11px 17px;
            border: 1px solid #cfe0d7;
            border-radius: 9px;
            background: white;
            color: #337a4b;
            text-decoration: none;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(70, 34, 56, 0.08);
        }

        .member-info {
            margin-bottom: 25px;
            padding: 18px;
            border-radius: 11px;
            background: #e7f5ef;
            color: #287b66;
        }

        .member-info strong {
            font-size: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #e5ece8;
            white-space: nowrap;
        }

        th {
            color: #71807a;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
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

        .view-button {
            padding: 8px 13px;
            border-radius: 8px;
            background: #dceef3;
            color: #216075;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .empty-message {
            padding: 25px;
            border-radius: 10px;
            background: #f8fbf9;
            color: #71807a;
            text-align: center;
        }

        @media (max-width: 700px) {
            .content {
                padding: 25px 18px;
            }

            .top-section {
                flex-direction: column;
                gap: 16px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<main class="content">

    <div class="top-section">
        <div>
            <h1>Transaction History</h1>

            <p class="subtitle">
                View all transactions and payments of this member.
            </p>
        </div>

        <a
            href="{{ route('members.show', $member) }}"
            class="back-button"
        >
            ← Back to Member Profile
        </a>
    </div>

    <div class="card">

        <div class="member-info">
            <strong>{{ $member->name }}</strong>
            <br>
            Membership Number: {{ $member->membership_number }}
        </div>

        @if ($member->membershipTransactions->count())

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction Number</th>
                            <th>Type</th>
                            <th>Level</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($member->membershipTransactions as $transaction)
                            <tr>
                                <td>
                                    {{ $transaction->transaction_number }}
                                </td>

                                <td>
                                    {{ ucfirst($transaction->transaction_type) }}
                                </td>

                                <td>
                                    {{ $transaction->membershipLevel?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    ₱{{ number_format($transaction->amount, 2) }}
                                </td>

                                <td>
                                    <span class="status {{ $transaction->status }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $transaction->transaction_date?->format('F d, Y') }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('transactions.show', $transaction) }}"
                                        class="view-button"
                                    >
                                        View
                                    </a>
                                </td>
                            </tr>

                            @if ($transaction->payments->count())
                                @foreach ($transaction->payments as $payment)
                                    <tr>
                                        <td colspan="2">
                                            Payment:
                                            {{ $payment->payment_reference }}
                                        </td>

                                        <td>
                                            {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                                        </td>

                                        <td>
                                            ₱{{ number_format($payment->amount, 2) }}
                                        </td>

                                        <td>
                                            Paid
                                        </td>

                                        <td>
                                            {{ $payment->payment_date?->format('F d, Y') }}
                                        </td>

                                        <td>
                                            Payment recorded
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="empty-message">
                No transaction history available for this member.
            </div>
        @endif

    </div>

</main>

</body>
</html>