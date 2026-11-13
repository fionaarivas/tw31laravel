<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction Receipt</title>

    <style>
        :root {
            --background: #17131b;
            --panel: #1d1922;
            --panel-light: #27212d;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --green: #72d69b;
            --blue: #78c9dd;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 28px 18px 60px;
            background:
                radial-gradient(
                    circle at 85% 0%,
                    rgba(142, 81, 157, .24),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #151219 0%,
                    #514653 52%,
                    #18131d 100%
                );
            color: var(--text);
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            width: 100%;
            max-width: 820px;
            margin: 0 auto 18px;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-width: 125px;
            min-height: 43px;
            padding: 11px 18px;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .print-button {
            background: linear-gradient(
                135deg,
                #e984c5,
                #bd71b5
            );
            color: white;
        }

        .back-button {
            border: 1px solid rgba(255, 255, 255, .16);
            background: rgba(255, 255, 255, .08);
            color: var(--muted);
        }

        .receipt {
            width: 100%;
            max-width: 820px;
            margin: 0 auto;
            padding: 42px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: rgba(29, 25, 34, .96);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .22);
        }

        .header {
            margin-bottom: 30px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(233, 132, 197, .5);
            text-align: center;
        }

        .brand {
            margin: 0;
            color: var(--text);
            font-size: 31px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .brand span {
            color: var(--pink);
        }

        .receipt-title {
            margin: 10px 0 0;
            color: var(--pink);
            font-size: 19px;
            font-weight: 800;
        }

        .reference {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .reference strong {
            color: var(--text);
        }

        .section {
            margin-bottom: 28px;
        }

        .section-title {
            margin-bottom: 15px;
            color: var(--pink);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px 18px;
        }

        .detail {
            min-width: 0;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: rgba(255, 255, 255, .035);
        }

        .label {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .value {
            display: block;
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .amount-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-top: 16px;
            padding: 17px;
            border: 1px solid rgba(114, 214, 155, .25);
            border-radius: 11px;
            background: rgba(114, 214, 155, .1);
        }

        .amount-label {
            color: var(--green);
            font-size: 13px;
            font-weight: 700;
        }

        .amount {
            color: var(--green);
            font-size: 22px;
            font-weight: 800;
        }

        .status {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(114, 214, 155, .14);
            color: var(--green);
            font-size: 12px;
            font-weight: 800;
            text-transform: capitalize;
        }

        .status::before {
            width: 6px;
            height: 6px;
            margin-right: 7px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .payment-table-wrapper {
            width: 100%;
            overflow-x: hidden;
            border: 1px solid var(--border);
            border-radius: 11px;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .payment-table th,
        .payment-table td {
            padding: 13px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .09);
            text-align: left;
            overflow-wrap: anywhere;
        }

        .payment-table tr:last-child td {
            border-bottom: none;
        }

        .payment-table th {
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .payment-table td {
            color: var(--text);
            font-size: 13px;
        }

        .notes {
            padding: 15px;
            border: 1px solid rgba(233, 132, 197, .25);
            border-left: 4px solid var(--pink);
            border-radius: 10px;
            background: rgba(233, 132, 197, .08);
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            white-space: pre-line;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            text-align: center;
        }

        @media (max-width: 650px) {
            body {
                padding: 20px 12px 40px;
            }

            .actions {
                justify-content: stretch;
            }

            .button {
                flex: 1;
                min-width: 0;
            }

            .receipt {
                padding: 25px 19px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .amount-box {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }

            .payment-table-wrapper {
                overflow-x: auto;
            }

            .payment-table {
                min-width: 620px;
                table-layout: auto;
            }
        }

        @media print {
            body {
                padding: 0;
                background: white;
                color: #222;
            }

            .actions {
                display: none;
            }

            .receipt {
                max-width: 100%;
                margin: 0;
                padding: 25px;
                border: none;
                border-radius: 0;
                background: white;
                box-shadow: none;
                color: #222;
            }

            .brand,
            .value,
            .payment-table td {
                color: #222;
            }

            .receipt-title,
            .section-title {
                color: #8e4c82;
            }

            .reference,
            .label,
            .footer {
                color: #666;
            }

            .detail {
                border-color: #ddd;
                background: white;
            }

            .amount-box {
                border-color: #b8dfc2;
                background: #eef9f1;
            }

            .notes {
                border-color: #e8bfd9;
                background: #fff5fa;
                color: #555;
            }

            .payment-table th,
            .payment-table td {
                border-color: #ddd;
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
            <strong>{{ $transaction->transaction_number }}</strong>
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

            <div class="payment-table-wrapper">
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
            </div>

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