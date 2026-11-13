<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transactions | Membership System</title>

    <style>
        :root {
            --background: #151219;
            --panel: #1c1821;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --pink-dark: #c967a8;
            --green: #72d69b;
            --orange: #e5a45d;
            --blue: #78c9dd;
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
            width: auto;
            margin-left: 0;
            padding: 30px 38px 55px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 27px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--pink);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .topbar h1 {
            margin: 0;
            color: var(--text);
            font-size: 35px;
            letter-spacing: -.8px;
        }

        .topbar p {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 45px;
            padding: 0 19px;
            border-radius: 10px;
            background: linear-gradient(
                135deg,
                var(--pink),
                #bd71b5
            );
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 9px 20px rgba(233, 132, 197, .2);
            transition: .2s ease;
        }

        .add-button:hover {
            background: var(--pink-dark);
            transform: translateY(-2px);
        }

        .content-card {
            width: 100%;
            padding: 25px 27px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(24, 21, 28, .95);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .22);
        }

        .flash-message,
        .error-message {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13px;
            transition: opacity .5s ease, transform .5s ease;
        }

        .flash-message.success {
            border: 1px solid rgba(114, 214, 155, .3);
            background: rgba(114, 214, 155, .1);
            color: var(--green);
        }

        .error-message {
            border: 1px solid rgba(240, 141, 168, .3);
            background: rgba(240, 141, 168, .1);
            color: #f08da8;
        }

        .flash-message.hide {
            opacity: 0;
            transform: translateY(-8px);
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        .search-input {
            flex: 1;
            min-width: 0;
            min-height: 42px;
            padding: 0 14px;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 9px;
            outline: none;
            background: #25202b;
            color: var(--text);
            font-size: 13px;
        }

        .search-input:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(233, 132, 197, .13);
        }

        .search-input::placeholder {
            color: #8e8795;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .search-button {
            background: var(--pink);
            color: #ffffff;
        }

        .search-button:hover {
            background: var(--pink-dark);
            transform: translateY(-1px);
        }

        .clear-button {
            background: #302a36;
            color: #d7ceda;
        }

        .clear-button:hover {
            background: #3b3342;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            padding: 16px 8px;
            border-bottom: 1px solid rgba(255, 255, 255, .09);
            text-align: left;
            vertical-align: middle;
        }

        th {
            color: #948b99;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 14%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 16%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 11%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 12%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 11%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 12%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 11%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 13%;
        }

        td {
            color: #d9d1dc;
            font-size: 12px;
            overflow-wrap: anywhere;
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

        .reference-number {
            color: var(--pink);
            font-weight: 750;
            overflow-wrap: normal;
            word-break: normal;
        }

        .amount {
            color: var(--green);
            font-weight: 750;
            white-space: nowrap;
        }

        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-width: 76px;
            min-height: 30px;
            padding: 0 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status::before {
            width: 6px;
            height: 6px;
            flex-shrink: 0;
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
            color: #f08da8;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 4px;
            width: 100%;
            white-space: nowrap;
        }

        .actions form {
            display: flex;
            margin: 0;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 34px;
            padding: 0 6px;
            border: none;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: .2s ease;
        }

        .view-button {
            width: 49px;
            background: rgba(120, 201, 221, .13);
            color: var(--blue);
        }

        .view-button:hover {
            background: rgba(120, 201, 221, .23);
        }

        .edit-button {
            width: 49px;
            background: rgba(229, 164, 93, .13);
            color: var(--orange);
        }

        .edit-button:hover {
            background: rgba(229, 164, 93, .23);
        }

        .delete-button {
            width: 57px;
            background: rgba(213, 100, 143, .16);
            color: #f18aaa;
        }

        .delete-button:hover {
            background: rgba(213, 100, 143, .28);
        }

        .empty-message {
            padding: 40px 25px;
            border: 1px dashed rgba(255, 255, 255, .18);
            border-radius: 13px;
            background: rgba(255, 255, 255, .025);
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 1150px) {
            .main {
                padding: 30px 25px 50px;
            }

            th,
            td {
                padding: 14px 5px;
                font-size: 11px;
            }

            th {
                font-size: 9px;
            }

            .action-button {
                padding: 0 4px;
                font-size: 9px;
            }

            .view-button,
            .edit-button {
                width: 43px;
            }

            .delete-button {
                width: 50px;
            }
        }

        @media (max-width: 950px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .add-button {
                width: 100%;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            table {
                min-width: 950px;
            }
        }

        @media (max-width: 700px) {
            .layout {
                display: block;
            }

            .main {
                padding: 25px 17px 40px;
            }

            .topbar h1 {
                font-size: 31px;
            }

            .search-form {
                align-items: stretch;
                flex-direction: column;
            }

            .search-button,
            .clear-button {
                width: 100%;
            }

            .content-card {
                padding: 18px 15px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">

        <div class="topbar">

            <div>
                <p class="eyebrow">Financial activity</p>

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
                <div class="flash-message success auto-dismiss">
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
                                        class="status {{ strtolower($transaction->status) }}"
                                    >
                                        {{ $transaction->status }}
                                    </span>
                                </td>

                                <td>
                                    {{
                                        $transaction->transaction_date
                                        ?->format('M d, Y')
                                    }}
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

<script>
    setTimeout(function () {
        document
            .querySelectorAll('.auto-dismiss')
            .forEach(function (message) {
                message.classList.add('hide');

                setTimeout(function () {
                    message.remove();
                }, 500);
            });
    }, 3000);
</script>

</body>
</html>