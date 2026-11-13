<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction Details</title>

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
            --orange: #e5a45d;
            --blue: #78c9dd;
            --red: #f08da8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 36px 42px 65px;
        }

        .content {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 25px;
            margin-bottom: 28px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--pink);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--text);
            font-size: 36px;
            line-height: 1.1;
            letter-spacing: -.8px;
        }

        .subtitle {
            margin: 10px 0 0;
            color: var(--muted);
            font-size: 15px;
        }

        .back-button {
            flex-shrink: 0;
            padding: 12px 17px;
            border: 1px solid rgba(233, 132, 197, .5);
            border-radius: 10px;
            background: rgba(233, 132, 197, .08);
            color: var(--pink);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: .2s ease;
        }

        .back-button:hover {
            background: rgba(233, 132, 197, .18);
            transform: translateY(-1px);
        }

        .alert {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 14px 17px;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 600;
            transition: opacity .5s ease, transform .5s ease;
        }

        .alert-success {
            border: 1px solid rgba(114, 214, 155, .3);
            background: rgba(114, 214, 155, .1);
            color: var(--green);
        }

        .alert-error {
            border: 1px solid rgba(240, 141, 168, .3);
            background: rgba(240, 141, 168, .1);
            color: var(--red);
        }

        .alert.hide {
            opacity: 0;
            transform: translateY(-8px);
        }

        .details-card {
            width: 100%;
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: rgba(29, 25, 34, .94);
            box-shadow: 0 18px 45px rgba(0, 0, 0, .18);
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 24px;
        }

        .section-icon {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            border: 1px solid rgba(233, 132, 197, .3);
            border-radius: 12px;
            background: rgba(233, 132, 197, .12);
            color: var(--pink);
            font-weight: 800;
        }

        .section-title {
            margin: 0;
            color: var(--text);
            font-size: 21px;
        }

        .reference-number {
            margin-bottom: 24px;
            color: var(--pink);
            font-size: 25px;
            font-weight: 800;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .detail-box {
            min-width: 0;
            padding: 17px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: rgba(255, 255, 255, .035);
        }

        .detail-label {
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .detail-value {
            color: var(--text);
            font-size: 15px;
            font-weight: 600;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .amount {
            color: var(--green);
            font-size: 20px;
            font-weight: 800;
        }

        .status {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            padding: 7px 12px;
            border-radius: 999px;
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

        .status.pending {
            background: rgba(229, 164, 93, .14);
            color: var(--orange);
        }

        .status.paid,
        .status.approved {
            background: rgba(114, 214, 155, .14);
            color: var(--green);
        }

        .status.expired,
        .status.cancelled {
            background: rgba(240, 141, 168, .14);
            color: var(--red);
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .notes-box {
            margin-top: 20px;
            padding: 17px;
            border: 1px solid rgba(233, 132, 197, .25);
            border-left: 4px solid var(--pink);
            border-radius: 12px;
            background: rgba(233, 132, 197, .08);
        }

        .notes-title {
            margin-bottom: 8px;
            color: var(--pink);
            font-size: 13px;
            font-weight: 800;
        }

        .notes-text {
            color: var(--muted);
            line-height: 1.6;
            white-space: pre-line;
        }

        .payment-section {
            margin-top: 30px;
        }

        .payment-section h3 {
            margin: 0 0 15px;
            color: var(--text);
            font-size: 18px;
        }

        .payment-table-wrapper {
            width: 100%;
            overflow-x: hidden;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .payment-table th,
        .payment-table td {
            padding: 14px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, .09);
            text-align: left;
            overflow-wrap: anywhere;
        }

        .payment-table tr:last-child td {
            border-bottom: none;
        }

        .payment-table th {
            color: var(--muted);
            font-size: 11px;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .payment-table td {
            color: var(--text);
            font-size: 13px;
        }

        .no-payment {
            padding: 16px;
            border: 1px dashed var(--border);
            border-radius: 11px;
            background: rgba(255, 255, 255, .03);
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 30px;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 42px;
            padding: 11px 17px;
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

        .back-bottom-button {
            background: rgba(255, 255, 255, .09);
            color: var(--muted);
        }

        .approve-button {
            background: rgba(114, 214, 155, .16);
            color: var(--green);
        }

        .receipt-button {
            background: rgba(120, 201, 221, .15);
            color: var(--blue);
        }

        @media (max-width: 900px) {
            .main {
                padding: 28px 24px 50px;
            }

            .details-card {
                padding: 25px;
            }
        }

        @media (max-width: 680px) {
            .main {
                padding: 24px 16px 40px;
            }

            .top-section {
                flex-direction: column;
            }

            .back-button {
                width: 100%;
                text-align: center;
            }

            h1 {
                font-size: 30px;
            }

            .details-card {
                padding: 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .payment-table-wrapper {
                overflow-x: auto;
            }

            .payment-table {
                min-width: 620px;
                table-layout: auto;
            }

            .button-row {
                align-items: stretch;
                flex-direction: column;
            }

            .button,
            .button-row form {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">
        <div class="content">

            <div class="top-section">
                <div>
                    <p class="eyebrow">Financial Activity</p>

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
                <div class="alert alert-success auto-dismiss">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error auto-dismiss">
                    {{ session('error') }}
                </div>
            @endif

            <section class="details-card">

                <div class="section-heading">
                    <div class="section-icon">T</div>

                    <h2 class="section-title">
                        Transaction Information
                    </h2>
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
                    <div class="notes-title">Notes</div>

                    <div class="notes-text">
                        {{ $transaction->notes ?: 'No notes provided.' }}
                    </div>
                </div>

                <div class="payment-section">
                    <h3>Payment Details</h3>

                    @forelse ($transaction->payments as $payment)
                        <div class="payment-table-wrapper">
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
                                        <td>
                                            {{ $payment->payment_reference }}
                                        </td>

                                        <td>
                                            ₱{{ number_format($payment->amount, 2) }}
                                        </td>

                                        <td>
                                            {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                                        </td>

                                        <td>
                                            {{ $payment->payment_date?->format('F d, Y') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @empty
                        <div class="no-payment">
                            No payment has been recorded for this transaction yet.
                        </div>
                    @endforelse
                </div>

                <div class="button-row">


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

                    @if (in_array($transaction->status, ['paid', 'approved']))
                        <a
                            href="{{ route('transactions.receipt', $transaction) }}"
                            class="button receipt-button"
                            target="_blank"
                        >
                            Print Receipt
                        </a>
                    @endif

                </div>

            </section>

        </div>
    </main>

</div>

<script>
    setTimeout(function () {
        document.querySelectorAll('.auto-dismiss').forEach(function (message) {
            message.classList.add('hide');

            setTimeout(function () {
                message.remove();
            }, 500);
        });
    }, 3000);
</script>

</body>
</html>