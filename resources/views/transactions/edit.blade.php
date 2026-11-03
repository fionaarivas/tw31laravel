<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Transaction</title>

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

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px 20px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .full-width {
            grid-column: 1 / -1;
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
            min-height: 125px;
            resize: vertical;
        }

        .help-text {
            margin-top: 8px;
            color: #718681;
            font-size: 13px;
            line-height: 1.5;
        }

        .error-box {
            margin-bottom: 24px;
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
            margin-top: 26px;
            padding: 15px 17px;
            border-radius: 11px;
            color: #287b66;
            background: #e7f5ef;
            font-size: 14px;
            line-height: 1.5;
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

        .update-button {
            color: white;
            background: #e875a8;
        }

        .update-button:hover {
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="page">

    <div class="page-header">
        <div>
            <h1>Edit Transaction</h1>
            <p class="subtitle">
                Update the transaction information.
            </p>
        </div>

        <a
            href="{{ route('transactions.show', $transaction) }}"
            class="back-button"
        >
            ← Back to Transaction
        </a>
    </div>

    <div class="card">

        <h2>Transaction Information</h2>

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
            action="{{ route('transactions.update', $transaction) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="transaction_number">
                        Transaction Number
                    </label>

                    <input
                        type="text"
                        id="transaction_number"
                        value="{{ $transaction->transaction_number }}"
                        readonly
                    >

                    <p class="help-text">
                        Transaction numbers cannot be changed.
                    </p>
                </div>

                <div class="form-group">
                    <label for="transaction_type">
                        Transaction Type
                    </label>

                    <select
                        name="transaction_type"
                        id="transaction_type"
                        required
                    >
                        <option value="application"
                            {{ old('transaction_type', $transaction->transaction_type) === 'application' ? 'selected' : '' }}>
                            New Application
                        </option>

                        <option value="renewal"
                            {{ old('transaction_type', $transaction->transaction_type) === 'renewal' ? 'selected' : '' }}>
                            Renewal
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="member_id">Member</label>

                    <select name="member_id" id="member_id" required>
                        @foreach ($members as $member)
                            <option
                                value="{{ $member->id }}"
                                {{ old('member_id', $transaction->member_id) == $member->id ? 'selected' : '' }}
                            >
                                {{ $member->membership_number }}
                                — {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="membership_level_id">
                        Membership Level
                    </label>

                    <select
                        name="membership_level_id"
                        id="membership_level_id"
                        required
                    >
                        @foreach ($levels as $level)
                            <option
                                value="{{ $level->id }}"
                                {{ old('membership_level_id', $transaction->membership_level_id) == $level->id ? 'selected' : '' }}
                            >
                                {{ $level->name }}
                                — ₱{{ number_format($level->fee, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="transaction_date">
                        Transaction Date
                    </label>

                    <input
                        type="date"
                        name="transaction_date"
                        id="transaction_date"
                        value="{{ old('transaction_date', optional($transaction->transaction_date)->format('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="status">Status</label>

                    <select name="status" id="status" required>
                        <option value="pending"
                            {{ old('status', $transaction->status) === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="expired"
                            {{ old('status', $transaction->status) === 'expired' ? 'selected' : '' }}>
                            Expired
                        </option>

                        <option value="cancelled"
                            {{ old('status', $transaction->status) === 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>
                    </select>

                    <p class="help-text">
                        Paid is set automatically after recording a payment.
                        Approved should only be used after payment.
                    </p>
                </div>

                <div class="form-group">
                    <label for="membership_start_date">
                        Membership Start Date
                    </label>

                    <input
                        type="date"
                        name="membership_start_date"
                        id="membership_start_date"
                        value="{{ old('membership_start_date', optional($transaction->membership_start_date)->format('Y-m-d')) }}"
                    >
                </div>

                <div class="form-group">
                    <label for="membership_end_date">
                        Membership End Date
                    </label>

                    <input
                        type="date"
                        name="membership_end_date"
                        id="membership_end_date"
                        value="{{ old('membership_end_date', optional($transaction->membership_end_date)->format('Y-m-d')) }}"
                    >
                </div>

                <div class="form-group full-width">
                    <label for="notes">Notes</label>

                    <textarea
                        name="notes"
                        id="notes"
                        placeholder="Optional transaction notes"
                    >{{ old('notes', $transaction->notes) }}</textarea>
                </div>

            </div>

            <div class="info-box">
                The transaction amount is based on the selected membership
                level. Payment processing is handled separately through the
                Payments page.
            </div>

            <div class="form-actions">
                <a
                    href="{{ route('transactions.show', $transaction) }}"
                    class="button cancel-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button update-button"
                >
                    Update Transaction
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>