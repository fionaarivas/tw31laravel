<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction History</title>

    <style>
        :root {
            --panel: #1c1821;
            --panel-light: #25202b;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --pink-dark: #c967a8;
            --green: #72d69b;
            --orange: #e5a45d;
            --blue: #78c9dd;
            --red: #f08da8;
        }

        * {
            box-sizing: border-box;
            font-family: inherit;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 82% 0%,
                    rgba(142, 81, 157, .22),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #151219 0%,
                    #5c4e59 52%,
                    #18131d 100%
                );
            color: var(--text);
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 34px 42px 60px;
        }

        .top-section,
        .history-card {
            width: 100%;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        .top-section {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 28px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--pink);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--text);
            font-size: 36px;
            letter-spacing: -.9px;
        }

        .subtitle {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 43px;
            padding: 0 17px;
            border: 1px solid rgba(233, 132, 197, .45);
            border-radius: 10px;
            background: rgba(233, 132, 197, .08);
            color: var(--pink);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: .2s ease;
        }

        .back-button:hover {
            background: rgba(233, 132, 197, .18);
            transform: translateY(-1px);
        }

        .history-card {
            padding: 30px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(24, 21, 28, .96);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .24);
        }

        .member-info {
            margin-bottom: 25px;
            padding: 18px;
            border: 1px solid rgba(233, 132, 197, .28);
            border-radius: 12px;
            background:
                linear-gradient(
                    135deg,
                    rgba(233, 132, 197, .13),
                    rgba(142, 81, 157, .1)
                );
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .member-info strong {
            color: var(--pink);
            font-size: 18px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            padding: 15px 11px;
            border-bottom: 1px solid rgba(255, 255, 255, .09);
            text-align: left;
            vertical-align: middle;
        }

        th {
            color: #948b99;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 19%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 12%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 14%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 12%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 14%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 17%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 12%;
        }

        td {
            color: #d9d1dc;
            font-size: 13px;
        }

        tbody tr {
            transition: .2s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, .035);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .transaction-number {
            color: var(--pink);
            font-weight: 750;
        }

        .amount {
            color: var(--green);
            font-weight: 750;
            white-space: nowrap;
        }

        .payment-row {
            background: rgba(120, 201, 221, .045);
        }

        .payment-row td {
            color: var(--muted);
            font-size: 12px;
        }

        .payment-reference {
            color: var(--blue) !important;
            font-weight: 700;
        }

        .payment-recorded {
            color: var(--green) !important;
            font-weight: 600;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 30px;
            padding: 0 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status::before {
            width: 6px;
            height: 6px;
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

        .view-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            padding: 0 13px;
            border-radius: 8px;
            background: rgba(120, 201, 221, .14);
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .view-button:hover {
            background: rgba(120, 201, 221, .25);
            transform: translateY(-1px);
        }

        .empty-message {
            padding: 30px 25px;
            border: 1px dashed rgba(255, 255, 255, .18);
            border-radius: 12px;
            background: rgba(255, 255, 255, .025);
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 900px) {
            .main {
                padding: 30px 25px 50px;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
            }

            .back-button {
                width: 100%;
            }

            .history-card {
                max-width: 100%;
            }
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .main {
                padding: 25px 17px 40px;
            }

            h1 {
                font-size: 31px;
            }

            .history-card {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">

        <div class="top-section">

            <div>
                <p class="eyebrow">
                    Financial activity
                </p>

                <h1>
                    Transaction History
                </h1>

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

        <div class="history-card">

            <div class="member-info">
                <strong>
                    {{ $member->name }}
                </strong>

                <br>

                Membership Number:
                {{ $member->membership_number }}
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
                                    <td class="transaction-number">
                                        {{ $transaction->transaction_number }}
                                    </td>

                                    <td>
                                        {{ ucfirst($transaction->transaction_type) }}
                                    </td>

                                    <td>
                                        {{
                                            $transaction->membershipLevel?->name
                                            ?? 'N/A'
                                        }}
                                    </td>

                                    <td class="amount">
                                        ₱{{ number_format($transaction->amount, 2) }}
                                    </td>

                                    <td>
                                        <span
                                            class="status {{ $transaction->status }}"
                                        >
                                            {{ $transaction->status }}
                                        </span>
                                    </td>

                                    <td>
                                        {{
                                            $transaction->transaction_date
                                            ?->format('F d, Y')
                                        }}
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

                                        <tr class="payment-row">

                                            <td
                                                colspan="2"
                                                class="payment-reference"
                                            >
                                                Payment:
                                                {{ $payment->payment_reference }}
                                            </td>

                                            <td>
                                                {{
                                                    ucwords(
                                                        str_replace(
                                                            '_',
                                                            ' ',
                                                            $payment->payment_method
                                                        )
                                                    )
                                                }}
                                            </td>

                                            <td class="amount">
                                                ₱{{ number_format($payment->amount, 2) }}
                                            </td>

                                            <td>
                                                <span class="status paid">
                                                    Paid
                                                </span>
                                            </td>

                                            <td>
                                                {{
                                                    $payment->payment_date
                                                    ?->format('F d, Y')
                                                }}
                                            </td>

                                            <td class="payment-recorded">
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

</div>

</body>
</html>