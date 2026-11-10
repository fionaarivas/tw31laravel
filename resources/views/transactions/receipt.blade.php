<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction Receipt</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef3f0;
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

        .actions {
            width: 100%;
            max-width: 760px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin: 25px auto 15px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 125px;
            height: 44px;
            border: none;
            border-radius: 10px;
            padding: 0 20px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .print-button {
            background: #e875a8;
            color: white;
        }

        .print-button:hover {
            background: #d95f94;
        }

        .back-button {
            background: white;
            color: #287b66;
            border: 1px solid #bcd8cc;
        }

        .back-button:hover {
            background: #e7f5ef;
            border-color: #287b66;
        }

        .receipt {
            width: 100%;
            max-width: 760px;
            margin: 0 auto 40px;
            padding: 42px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, .1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #e875a8;
            padding-bottom: 24px;
            margin-bottom: 28px;
        }

        .brand {
            margin: 0;
            color: #193b35;
            font-size: 30px;
            font-weight: 700;
        }

        .brand span {
            color: #e875a8;
        }

        .receipt-title {
            margin: 10px 0 0;
            color: #337a4b;
            font-size: 21px;
            font-weight: 600;
        }

        .reference {
            margin-top: 8px;
            color: #71807a;
            font-size: 14px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            margin-bottom: 13px;
            color: #337a4b;
            font-size: 16px;
            font-weight: 700;
        }

        .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px 28px;
        }

        .detail {
            padding-bottom: 11px;
            border-bottom: 1px solid #e5ece8;
        }

        .label {
            display: block;
            margin-bottom: 5px;
            color: #71807a;
            font-size: 12px;
            text-transform: uppercase;
        }

        .value {
            color: #26332f;
            font-size: 15px;
            font-weight: 600;
        }

        .amount-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 17px;
            border-radius: 10px;
            background: #e7f5ef;
        }

        .amount-label {
            color: #287b66;
            font-weight: 600;
        }

        .amount {
            color: #287b66;
            font-size: 22px;
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #e2f4e4;
            color: #337a4b;
            font-size: 13px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-table th,
        .payment-table td {
            padding: 11px 8px;
            border-bottom: 1px solid #e5ece8;
            text-align: left;
            font-size: 13px;
        }

        .payment-table th {
            color: #71807a;
            font-size: 11px;
            text-transform: uppercase;
        }

        .notes {
            padding: 14px;
            border-left: 4px solid #e875a8;
            border-radius: 8px;
            background: #fff5f8;
            color: #52635b;
            line-height: 1.6;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5ece8;
            color: #71807a;
            text-align: center;
            font-size: 13px;
        }

        @media print {
            body {
                background: white;
            }

            .receipt {
                max-width: 100%;
                margin: 0;
                padding: 20px;
                box-shadow: none;
            }

            .actions {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .actions {
                padding: 0 15px;
                justify-content: center;
            }

            .receipt {
                margin: 0 15px 25px;
                padding: 25px 20px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .amount-box {
                display: block;
            }

            .amount {
                display: block;
                margin-top: 8px;
            }

            .button {
                min-width: 0;
                flex: 1;
            }
        }
    </style>
</head>

<body>

<div class="actions">

    <button
        type="button"
        class="button print-button"
        onclick="window.print()"
    >
        Print Receipt
    </button>

    <a
        href="{{ route('transactions.show', $transaction) }}"
        class="button back-button"
    >
        ← Back
    </a>

</div>

<main class="receipt">

    <header class="header">
        <h1 class="brand">
            Member<span>ship</span>
        </h1>

        <p class="receipt-title">
            Official Transaction Receipt
        </p>

        <p class="reference">
            Transaction No.
            {{ $transaction->transaction_number }}
        </p>
    </header>

    <section class="section">

        <div class="section-title">
            Member Information
        </div>

        <div class="details">

            <div class="detail">
                <span class="label">Member Name</span>

                <span class="value">
                    {{ $transaction->member?->name ?? 'N/A' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Membership Number</span>

                <span class="value">
                    {{ $transaction->member?->membership_number ?? 'N/A' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Email</span>

                <span class="value">
                    {{ $transaction->member?->email ?? 'N/A' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Phone Number</span>

                <span class="value">
                    {{ $transaction->member?->phone_number ?? 'N/A' }}
                </span>
            </div>

        </div>

    </section>

    <section class="section">

        <div class="section-title">
            Transaction Information
        </div>

        <div class="details">

            <div class="detail">
                <span class="label">Transaction Type</span>

                <span class="value">
                    {{ ucfirst($transaction->transaction_type) }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Membership Level</span>

                <span class="value">
                    {{ $transaction->membershipLevel?->name ?? 'N/A' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Transaction Date</span>

                <span class="value">
                    {{ $transaction->transaction_date?->format('F d, Y') }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Status</span>

                <span class="status">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>

        </div>

        <div class="amount-box">
            <span class="amount-label">
                Total Transaction Amount
            </span>

            <span class="amount">
                ₱{{ number_format($transaction->amount, 2) }}
            </span>
        </div>

    </section>

    <section class="section">

        <div class="section-title">
            Payment Details
        </div>

        @forelse ($transaction->payments as $payment)

            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Payment Reference</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            {{ $payment->payment_reference }}
                        </td>

                        <td>
                            {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                        </td>

                        <td>
                            {{ $payment->payment_date?->format('F d, Y') }}
                        </td>

                        <td>
                            ₱{{ number_format($payment->amount, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>

        @empty

            <div class="notes">
                No payment has been recorded for this transaction.
            </div>

        @endforelse

    </section>

    <section class="section">

        <div class="section-title">
            Notes
        </div>

        <div class="notes">
            {{ $transaction->notes ?: 'No notes provided.' }}
        </div>

    </section>

    <footer class="footer">
        Thank you for using the Membership Management System.
        <br>
        Generated on {{ now()->format('F d, Y h:i A') }}
    </footer>

</main>

</body>
</html>