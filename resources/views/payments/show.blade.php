<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment Details</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7faf9;
            color: #102d2a;
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

        .page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 42px 34px 70px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 38px;
        }

        h1 {
            margin: 0;
            font-size: 34px;
            letter-spacing: -1px;
        }

        .subtitle {
            margin-top: 10px;
            color: #66807b;
            font-size: 16px;
        }

        .back-button {
            text-decoration: none;
            color: #287b66;
            border: 1px solid #cfe0da;
            border-radius: 11px;
            padding: 13px 18px;
            background: white;
            font-size: 14px;
        }

        .back-button:hover {
            background: #edf7f3;
        }

        .card {
            background: white;
            border-radius: 22px;
            padding: 38px 42px;
            box-shadow: 0 12px 35px rgba(25, 59, 53, 0.08);
        }

        h2 {
            margin: 0 0 28px;
            color: #287b66;
            font-size: 22px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px 40px;
        }

        .detail {
            border-bottom: 1px solid #edf2f0;
            padding-bottom: 16px;
        }

        .detail-label {
            display: block;
            margin-bottom: 7px;
            color: #86717a;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .detail-value {
            color: #173b36;
            font-size: 16px;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 999px;
            background: #f4e2ec;
            color: #0b0b0b;
            font-size: 13px;
            font-weight: 700;
        }

        .notes {
            grid-column: 1 / -1;
        }

        .notes-content {
            padding: 15px;
            border-radius: 11px;
            background: #f7faf9;
            color: #536863;
            line-height: 1.6;
            white-space: pre-line;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
        }

        .button {
            border: none;
            border-radius: 11px;
            padding: 13px 21px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
        }


        .back-link {
            color: #536863;
            background: #edf2f0;
        }

        @media (max-width: 700px) {
            .page {
                padding: 28px 18px 50px;
            }

            .page-header {
                display: block;
            }

            .back-button {
                display: inline-block;
                margin-top: 20px;
            }

            .card {
                padding: 28px 22px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .notes {
                grid-column: auto;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="page">

    <div class="page-header">
        <div>
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

    <div class="card">

        <h2>Payment Information</h2>

        <div class="details-grid">

            <div class="detail">
                <span class="detail-label">Payment Reference</span>
                <span class="detail-value">
                    {{ $payment->payment_reference }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Payment Date</span>
                <span class="detail-value">
                    {{ $payment->payment_date?->format('F d, Y') }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Transaction Number</span>
                <span class="detail-value">
                    {{ $payment->membershipTransaction->transaction_number }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Member</span>
                <span class="detail-value">
                    {{ $payment->membershipTransaction->member->name }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Payment Amount</span>
                <span class="detail-value">
                    ₱{{ number_format($payment->amount, 2) }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value">
                    {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Transaction Status</span>
                <span class="status">
                    {{ ucfirst($payment->membershipTransaction->status) }}
                </span>
            </div>

            <div class="detail">
                <span class="detail-label">Membership Level</span>
                <span class="detail-value">
                    {{ $payment->membershipTransaction->membershipLevel->name }}
                </span>
            </div>

            <div class="detail notes">
                <span class="detail-label">Notes</span>

                <div class="notes-content">
                    {{ $payment->notes ?: 'No notes provided.' }}
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>