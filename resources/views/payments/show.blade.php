<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment Details</title>

    <style>
        :root {
            --panel: #1d1922;
            --panel-light: #27212d;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --green: #72d69b;
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

        .page {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
        }

        .page-header {
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
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .back-button:hover {
            background: rgba(233, 132, 197, .18);
            transform: translateY(-1px);
        }

        .card {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: rgba(29, 25, 34, .95);
            box-shadow: 0 18px 45px rgba(0, 0, 0, .18);
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 28px;
        }

        .card-icon {
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

        h2 {
            margin: 0;
            color: var(--text);
            font-size: 21px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .detail {
            min-width: 0;
            padding: 17px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: rgba(255, 255, 255, .035);
        }

        .detail-label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .detail-value {
            display: block;
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

        .notes {
            grid-column: 1 / -1;
        }

        .notes-content {
            padding: 15px;
            border: 1px solid rgba(233, 132, 197, .22);
            border-left: 4px solid var(--pink);
            border-radius: 10px;
            background: rgba(233, 132, 197, .08);
            color: var(--muted);
            line-height: 1.6;
            white-space: pre-line;
        }

        @media (max-width: 900px) {
            .main {
                padding: 28px 24px 50px;
            }
        }

        @media (max-width: 680px) {
            .main {
                padding: 24px 16px 40px;
            }

            .page-header {
                flex-direction: column;
            }

            .back-button {
                width: 100%;
                text-align: center;
            }

            h1 {
                font-size: 30px;
            }

            .card {
                padding: 23px 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .notes {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">
        <div class="page">

            <div class="page-header">
                <div>
                    <p class="eyebrow">Financial Activity</p>

                    <h1>Payment Details</h1>

                    <p class="subtitle">
                        View the complete payment information.
                    </p>
                </div>

                <a
                    href="{{ route('payments.index') }}"
                    class="back-button"
                >
                    ← Back to Payments
                </a>
            </div>

            <section class="card">

                <div class="card-heading">
                    <div class="card-icon">₱</div>

                    <h2>Payment Information</h2>
                </div>

                <div class="details-grid">

                    <div class="detail">
                        <span class="detail-label">
                            Payment Reference
                        </span>

                        <span class="detail-value">
                            {{ $payment->payment_reference }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Payment Date
                        </span>

                        <span class="detail-value">
                            {{ $payment->payment_date?->format('F d, Y') }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Transaction Number
                        </span>

                        <span class="detail-value">
                            {{ $payment->membershipTransaction->transaction_number }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Member
                        </span>

                        <span class="detail-value">
                            {{ $payment->membershipTransaction->member->name }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Payment Amount
                        </span>

                        <span class="detail-value amount">
                            ₱{{ number_format($payment->amount, 2) }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Payment Method
                        </span>

                        <span class="detail-value">
                            {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Transaction Status
                        </span>

                        <span class="status">
                            {{ ucfirst($payment->membershipTransaction->status) }}
                        </span>
                    </div>

                    <div class="detail">
                        <span class="detail-label">
                            Membership Level
                        </span>

                        <span class="detail-value">
                            {{ $payment->membershipTransaction->membershipLevel->name }}
                        </span>
                    </div>

                    <div class="detail notes">
                        <span class="detail-label">
                            Notes
                        </span>

                        <div class="notes-content">
                            {{ $payment->notes ?: 'No notes provided.' }}
                        </div>
                    </div>

                </div>

            </section>

        </div>
    </main>

</div>

</body>
</html>