<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Membership Transaction</title>

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

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1,
        h2,
        h3,
        button,
        input,
        select,
        textarea,
        a {
            font-family: inherit;
        }

        .content {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
            padding: 45px 35px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .subtitle {
            color: #71807a;
            margin-top: 9px;
            font-size: 15px;
        }

        .back-button {
            background: white;
            color: #337a4b;
            border: 1px solid #cfe0d7;
            padding: 11px 17px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
        }

        .back-button:hover {
            background: #eef7f1;
        }

        .form-card {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, 0.08);
        }

        .section-title {
            color: #337a4b;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .info-message {
            background: #eef7f1;
            border: 1px solid #cfe5d5;
            color: #337a4b;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
            line-height: 1.5;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #d7e3dd;
            border-radius: 9px;
            background: #fbfdfc;
            color: #26332f;
            font-size: 14px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #86c98b;
            box-shadow: 0 0 0 3px rgba(134, 201, 139, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .input-help {
            color: #71807a;
            font-size: 13px;
            margin-top: 6px;
        }

        .error {
            color: #d95378;
            font-size: 13px;
            margin-top: 6px;
        }

        .general-errors {
            background: #fff0f4;
            color: #b83e64;
            border: 1px solid #f2bfd0;
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 22px;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            border: none;
            padding: 12px 20px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .cancel-button {
            background: #eef3f0;
            color: #52635b;
        }

        .cancel-button:hover {
            background: #dfe9e4;
        }

        .save-button {
            background: #e875a8;
            color: white;
            font-weight: 600;
        }

        .save-button:hover {
            background: #d95f94;
        }

        @media (max-width: 700px) {
            .content {
                padding: 25px 18px;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .form-card {
                padding: 22px;
            }

            .button-row {
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <main class="content">

        <div class="top-section">

            <div>
                <h1>New Membership Transaction</h1>

                <p class="subtitle">
                    Create a new membership application or renewal.
                </p>
            </div>

            <a
                href="{{ route('transactions.index') }}"
                class="back-button"
            >
                ← Back to Transactions
            </a>

        </div>

        <div class="form-card">

            @if ($errors->any())
                <div class="general-errors">
                    Please correct the errors below.
                </div>
            @endif

            <div class="section-title">
                Transaction Information
            </div>

            <div class="info-message">
                The transaction will automatically receive a unique
                reference number and will be saved with a
                <strong>Pending</strong> status.
            </div>

            <form
                action="{{ route('transactions.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label for="member_id">
                            Member
                        </label>

                        <select
                            id="member_id"
                            name="member_id"
                            required
                        >
                            <option value="">
                                Select member
                            </option>

                            @foreach ($members as $member)
                                <option
                                    value="{{ $member->id }}"
                                    {{ old('member_id') == $member->id ? 'selected' : '' }}
                                >
                                    {{ $member->membership_number }} —
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('member_id')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="membership_level_id">
                            Membership Level
                        </label>

                        <select
                            id="membership_level_id"
                            name="membership_level_id"
                            required
                        >
                            <option value="">
                                Select membership level
                            </option>

                            @foreach ($levels as $level)
                                <option
                                    value="{{ $level->id }}"
                                    {{ old('membership_level_id') == $level->id ? 'selected' : '' }}
                                >
                                    {{ $level->name }} —
                                    ₱{{ number_format($level->fee, 2) }}
                                </option>
                            @endforeach
                        </select>

                        <small class="input-help">
                            The transaction amount will use the selected
                            level's fee.
                        </small>

                        @error('membership_level_id')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="transaction_type">
                            Transaction Type
                        </label>

                        <select
                            id="transaction_type"
                            name="transaction_type"
                            required
                        >
                            <option value="">
                                Select transaction type
                            </option>

                            <option
                                value="application"
                                {{ old('transaction_type') === 'application' ? 'selected' : '' }}
                            >
                                New Application
                            </option>

                            <option
                                value="renewal"
                                {{ old('transaction_type') === 'renewal' ? 'selected' : '' }}
                            >
                                Renewal
                            </option>
                        </select>

                        @error('transaction_type')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="transaction_date">
                            Transaction Date
                        </label>

                        <input
                            type="date"
                            id="transaction_date"
                            name="transaction_date"
                            value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                            required
                        >

                        @error('transaction_date')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="notes">
                            Notes
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            placeholder="Add optional notes about this transaction"
                        >{{ old('notes') }}</textarea>

                        @error('notes')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="button-row">

                    <a
                        href="{{ route('transactions.index') }}"
                        class="button cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="button save-button"
                    >
                        Create Transaction
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>