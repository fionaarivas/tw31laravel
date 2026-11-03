<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Record Payment</title>

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

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-weight: 600;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #cfe0da;
            border-radius: 11px;
            padding: 14px 13px;
            background: #fcfefd;
            color: #173b36;
            font-size: 15px;
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #e875a8;
            box-shadow: 0 0 0 3px rgba(232, 117, 168, 0.14);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .help-text {
            margin-top: 8px;
            color: #718681;
            font-size: 13px;
        }

        .error-box {
            margin-bottom: 22px;
            padding: 14px 16px;
            border-radius: 11px;
            color: #a83258;
            background: #fde4ee;
            font-size: 14px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .info-box {
            margin: 25px 0;
            padding: 15px 17px;
            border-radius: 11px;
            color: #287b66;
            background: #e7f5ef;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            border: none;
            border-radius: 11px;
            padding: 14px 23px;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
        }

        .cancel-button {
            color: #536863;
            background: #edf2f0;
        }

        .save-button {
            color: white;
            background: #e875a8;
        }

        .save-button:hover {
            background: #d95f94;
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

            .form-actions {
                flex-direction: column-reverse;
            }

            .button {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="page">

    <div class="page-header">
        <div>
            <h1>Record Payment</h1>
            <p class="subtitle">
                Record a payment for a membership transaction.
            </p>
        </div>

        <a href="{{ route('payments.index') }}" class="back-button">
            ← Back to Payments
        </a>
    </div>

    <div class="card">

        <h2>Payment Information</h2>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="membership_transaction_id">
                    Membership Transaction
                </label>

                <select
                    name="membership_transaction_id"
                    id="membership_transaction_id"
                    required
                >
                    <option value="">Select a pending transaction</option>

                    @foreach ($transactions as $transaction)
                        <option
                            value="{{ $transaction->id }}"
                            {{ old('membership_transaction_id') == $transaction->id ? 'selected' : '' }}
                        >
                            {{ $transaction->transaction_number }}
                            —
                            {{ $transaction->member->name }}
                            —
                            ₱{{ number_format($transaction->amount, 2) }}
                        </option>
                    @endforeach
                </select>

                <p class="help-text">
                    Only pending transactions can receive a payment.
                </p>
            </div>

            <div class="form-group">
                <label for="amount">Payment Amount</label>

                <input
                    type="number"
                    name="amount"
                    id="amount"
                    step="0.01"
                    min="0.01"
                    value="{{ old('amount') }}"
                    placeholder="Example: 1500.00"
                    required
                >
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>

                <select
                    name="payment_method"
                    id="payment_method"
                    required
                >
                    <option value="">Select payment method</option>
                    <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>
                        Cash
                    </option>
                    <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>
                        Bank Transfer
                    </option>
                    <option value="e_wallet" {{ old('payment_method') === 'e_wallet' ? 'selected' : '' }}>
                        E-Wallet
                    </option>
                    <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>
                        Card
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="payment_date">Payment Date</label>

                <input
                    type="date"
                    name="payment_date"
                    id="payment_date"
                    value="{{ old('payment_date', date('Y-m-d')) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>

                <textarea
                    name="notes"
                    id="notes"
                    placeholder="Optional payment notes"
                >{{ old('notes') }}</textarea>
            </div>

            <div class="info-box">
                After saving this payment, the selected transaction will automatically
                be marked as <strong>Paid</strong>.
            </div>

            <div class="form-actions">
                <a
                    href="{{ route('payments.index') }}"
                    class="button cancel-button"
                >
                    Cancel
                </a>

                <button type="submit" class="button save-button">
                    Save Payment
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>