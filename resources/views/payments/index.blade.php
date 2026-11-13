<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Payments | Membership System</title>

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
                    #5f545a 52%,
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

        * {
            font-family: inherit;
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
            background:
                linear-gradient(
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
            background: rgba(24, 21, 28, .95);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 16px 36px rgba(0, 0, 0, .22);
        }

        .success-message,
        .error-message,
        .flash-message {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13px;
        }

        .flash-message {
            transition: opacity .5s ease, transform .5s ease;
        }

        .flash-message.success {
            border: 1px solid rgba(114, 214, 155, .3);
            background: rgba(114, 214, 155, .1);
            color: var(--green);
        }

        .flash-message.hide {
            opacity: 0;
            transform: translateY(-8px);
        }

        .error-message {
            border: 1px solid rgba(240, 141, 168, .3);
            background: rgba(240, 141, 168, .1);
            color: #f08da8;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        .search-input {
            flex: 1;
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
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 13px;
            border-bottom: 1px solid rgba(255, 255, 255, .09);
            text-align: left;
        }

        th {
            color: #948b99;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        td {
            color: #d9d1dc;
            font-size: 13px;
            vertical-align: middle;
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

        .payment-reference {
            color: var(--pink);
            font-weight: 750;
        }

        .amount {
            color: var(--green);
            font-weight: 750;
            white-space: nowrap;
        }

        .method {
            color: var(--muted);
            text-transform: capitalize;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .actions form {
            display: inline-flex;
            margin: 0;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            padding: 0 10px;
            border: none;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: .2s ease;
        }

        .view-button {
            width: 58px;
            background: rgba(120, 201, 221, .13);
            color: var(--blue);
        }

        .view-button:hover {
            background: rgba(120, 201, 221, .23);
        }

        .edit-button {
            width: 58px;
            background: rgba(229, 164, 93, .13);
            color: var(--orange);
        }

        .edit-button:hover {
            background: rgba(229, 164, 93, .23);
        }

        .delete-button {
            width: 64px;
            background: rgba(213, 100, 143, .16);
            color: #f18aaa;
        }

        .delete-button:hover {
            background: rgba(213, 100, 143, .28);
        }

        .empty-message {
            padding: 35px;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 900px) {
            .main {
                padding: 30px 27px 50px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
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

            .add-button {
                width: 100%;
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

                <h1>Payments</h1>

                <p>
                    Record and manage membership payments.
                </p>
            </div>

            <a
                href="{{ route('payments.create') }}"
                class="add-button"
            >
                + Record Payment
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
                action="{{ route('payments.index') }}"
                method="GET"
                class="search-form"
            >
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    value="{{ $search ?? '' }}"
                    placeholder="Search payment reference, transaction, or member..."
                >

                <button
                    type="submit"
                    class="button search-button"
                >
                    Search
                </button>

                <a
                    href="{{ route('payments.index') }}"
                    class="button clear-button"
                >
                    Clear
                </a>
            </form>

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Payment Reference</th>
                            <th>Transaction No.</th>
                            <th>Member</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($payments as $payment)

                            <tr>
                                <td class="payment-reference">
                                    {{ $payment->payment_reference }}
                                </td>

                                <td>
                                    {{
                                        $payment->membershipTransaction
                                        ?->transaction_number
                                        ?? 'N/A'
                                    }}
                                </td>

                                <td>
                                    {{
                                        $payment->membershipTransaction
                                        ?->member?->name
                                        ?? 'N/A'
                                    }}
                                </td>

                                <td class="amount">
                                    ₱{{ number_format($payment->amount, 2) }}
                                </td>

                                <td class="method">
                                    {{
                                        str_replace(
                                            '_',
                                            ' ',
                                            $payment->payment_method
                                        )
                                    }}
                                </td>

                                <td>
                                    {{
                                        $payment->payment_date
                                        ?->format('M d, Y')
                                    }}
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('payments.show', $payment) }}"
                                            class="action-button view-button"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('payments.edit', $payment) }}"
                                            class="action-button edit-button"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('payments.destroy', $payment) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this payment record?')"
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
                                    colspan="7"
                                    class="empty-message"
                                >
                                    No payment records found.
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