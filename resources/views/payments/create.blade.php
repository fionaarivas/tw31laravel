<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Record Payment</title>

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
            margin-bottom: 26px;
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

        .error-box {
            margin-bottom: 22px;
            padding: 14px 16px;
            border: 1px solid rgba(240, 141, 168, .3);
            border-radius: 11px;
            background: rgba(240, 141, 168, .1);
            color: var(--red);
            font-size: 13px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 21px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--panel-light);
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
            transition: .2s ease;
        }

        select option {
            background: var(--panel-light);
            color: var(--text);
        }

        input::placeholder,
        textarea::placeholder {
            color: #8f8695;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(233, 132, 197, .12);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .help-text {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 28px;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 43px;
            padding: 11px 19px;
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

        .cancel-button {
            background: rgba(255, 255, 255, .09);
            color: var(--muted);
        }

        .save-button {
            background: linear-gradient(
                135deg,
                #e984c5,
                #bd71b5
            );
            color: white;
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

            .form-actions {
                flex-direction: column-reverse;
            }

            .button {
                width: 100%;
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

                    <h1>Record Payment</h1>

                    <p class="subtitle">
                        Record a payment for a membership transaction.
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

                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('payments.store') }}"
                    method="POST"
                >
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
                            <option value="">
                                Select a pending transaction
                            </option>

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
                        <label for="amount">
                            Payment Amount
                        </label>

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
                        <label for="payment_method">
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            id="payment_method"
                            required
                        >
                            <option value="">
                                Select payment method
                            </option>

                            <option
                                value="cash"
                                {{ old('payment_method') === 'cash' ? 'selected' : '' }}
                            >
                                Cash
                            </option>

                            <option
                                value="bank_transfer"
                                {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}
                            >
                                Bank Transfer
                            </option>

                            <option
                                value="e_wallet"
                                {{ old('payment_method') === 'e_wallet' ? 'selected' : '' }}
                            >
                                E-Wallet
                            </option>

                            <option
                                value="card"
                                {{ old('payment_method') === 'card' ? 'selected' : '' }}
                            >
                                Card
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_date">
                            Payment Date
                        </label>

                        <input
                            type="date"
                            name="payment_date"
                            id="payment_date"
                            value="{{ old('payment_date', date('Y-m-d')) }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="notes">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            id="notes"
                            placeholder="Optional payment notes"
                        >{{ old('notes') }}</textarea>
                    </div>

                    <div class="form-actions">
                        <a
                            href="{{ route('payments.index') }}"
                            class="button cancel-button"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="button save-button"
                        >
                            Save Payment
                        </button>
                    </div>

                </form>

            </section>

        </div>
    </main>

</div>

</body>
</html>