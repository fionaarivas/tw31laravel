<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transactions | Membership System</title>

    <style>
        :root {
            --background: #f8faf9;
            --sidebar: #193b35;
            --white: #ffffff;
            --pink: #e875a8;
            --pink-hover: #d95f94;
            --green-dark: #337a4b;
            --text: #26332f;
            --muted: #71807a;
            --border: #e4ebe7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            background: var(--sidebar);
            padding: 25px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            color: white;
            font-size: 21px;
            font-weight: 700;
            padding: 10px 12px 28px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .brand span {
            color: #f6a8c7;
        }

        .menu-title {
            margin: 30px 12px 10px;
            color: #b9d4c9;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu a {
            display: block;
            color: #d8e8df;
            text-decoration: none;
            padding: 13px 14px;
            margin: 6px 0;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--pink);
            color: white;
            font-weight: 700;
        }

        .menu a.disabled {
            color: #78958b;
            cursor: not-allowed;
        }

        .main {
            width: calc(100% - 245px);
            margin-left: 245px;
            padding: 35px 45px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 34px;
            letter-spacing: -0.8px;
        }

        .topbar p {
            margin-top: 10px;
            color: var(--muted);
            font-size: 15px;
        }

        .add-button {
            background: var(--pink);
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .add-button:hover {
            background: var(--pink-hover);
        }

        .content-card {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(34, 70, 55, 0.06);
        }

        .success-message,
        .error-message {
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: #e4f5e7;
            color: var(--green-dark);
        }

        .error-message {
            background: #fff0f4;
            color: #b83e64;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
        }

        .search-input {
            flex: 1;
            border: 1px solid #d7e3dd;
            border-radius: 9px;
            padding: 12px;
            font-size: 14px;
            background: #fbfdfc;
        }

        .search-input:focus {
            outline: none;
            border-color: #86c98b;
            box-shadow: 0 0 0 3px rgba(134, 201, 139, 0.2);
        }

        .button {
            border: none;
            border-radius: 9px;
            padding: 11px 16px;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
        }

        .search-button {
            background: var(--green-dark);
            color: white;
        }

        .clear-button {
            background: #eef3f0;
            color: #52635b;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1150px;
        }

        th {
            color: var(--muted);
            text-align: left;
            padding: 13px;
            font-size: 12px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 15px 13px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover {
            background: #fff7fa;
        }

        .reference-number {
            color: var(--green-dark);
            font-weight: 600;
        }

        .amount {
            color: var(--green-dark);
            font-weight: 700;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status.pending {
            background: #fff0d8;
            color: #a8631b;
        }

        .status.paid,
        .status.approved {
            background: #e2f4e4;
            color: var(--green-dark);
        }

        .status.expired,
        .status.cancelled {
            background: #fff0f4;
            color: #b83e64;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-button {
            border: none;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .view-button {
            background: #dceef3;
            color: #216075;
        }

        .edit-button {
            background: #fff0d8;
            color: #a8631b;
        }

        .delete-button {
            background: #f8d8e1;
            color: #a83258;
        }

        .empty-message {
            text-align: center;
            color: var(--muted);
            padding: 35px;
        }

        @media (max-width: 900px) {
            .main {
                padding: 30px 25px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 205px;
            }

            .main {
                width: calc(100% - 205px);
                margin-left: 205px;
                padding: 25px 18px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-button,
            .clear-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="layout">

        <aside class="sidebar">

            <div class="brand">
                Member<span>ship</span>
            </div>

            <div class="menu-title">
                Main Menu
            </div>

            <nav class="menu">
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a href="{{ route('members.index') }}">
                    Members
                </a>

                <a href="{{ route('membership-categories.index') }}">
                    Membership Categories
                </a>
            </nav>

            <div class="menu-title">
                Management
            </div>

            <nav class="menu">
                <a href="{{ route('membership-levels.index') }}">
                    Membership Levels
                </a>

                <a
                    href="{{ route('transactions.index') }}"
                    class="active"
                >
                    Transactions
                </a>

                <a
                    href="{{ route('payments.index') }}"
                >
                    Payments
                </a>
            </nav>

        </aside>

        <main class="main">

            <div class="topbar">

                <div>
                    <h1>Membership Transactions</h1>

                    <p>
                        Manage membership applications and renewals.
                    </p>
                </div>

                <a
                    href="{{ route('transactions.create') }}"
                    class="add-button"
                >
                    + New Transaction
                </a>

            </div>

            <section class="content-card">

                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="error-message">
                        {{ session('error') }}
                    </div>
                @endif

                <form
                    action="{{ route('transactions.index') }}"
                    method="GET"
                    class="search-form"
                >
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        value="{{ $search ?? '' }}"
                        placeholder="Search reference number, member, type, or status..."
                    >

                    <button
                        type="submit"
                        class="button search-button"
                    >
                        Search
                    </button>

                    <a
                        href="{{ route('transactions.index') }}"
                        class="button clear-button"
                    >
                        Clear
                    </a>
                </form>

                <div class="table-wrapper">

                    <table>
                        <thead>
                            <tr>
                                <th>Reference No.</th>
                                <th>Member</th>
                                <th>Type</th>
                                <th>Level</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($transactions as $transaction)

                                <tr>
                                    <td class="reference-number">
                                        {{ $transaction->transaction_number }}
                                    </td>

                                    <td>
                                        {{ $transaction->member?->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ ucfirst($transaction->transaction_type) }}
                                    </td>

                                    <td>
                                        {{ $transaction->membershipLevel?->name ?? 'N/A' }}
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
                                        {{ $transaction->transaction_date?->format('M d, Y') }}
                                    </td>

                                    <td>
                                        <div class="actions">

                                            <a
                                                href="{{ route('transactions.show', $transaction) }}"
                                                class="action-button view-button"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('transactions.edit', $transaction) }}"
                                                class="action-button edit-button"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('transactions.destroy', $transaction) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this transaction?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-button delete-button"
                                                >
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="8"
                                        class="empty-message"
                                    >
                                        No membership transactions found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

            </section>

        </main>

    </div>

</body>
</html>