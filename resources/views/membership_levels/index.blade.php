<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Membership Levels</title>

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

        .success-message,
        .error-message {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13px;
        }

        .success-message {
            border: 1px solid rgba(114, 214, 155, .3);
            background: rgba(114, 214, 155, .1);
            color: var(--green);
        }

        .error-message {
            border: 1px solid rgba(240, 141, 168, .3);
            background: rgba(240, 141, 168, .1);
            color: #f08da8;
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
            padding: 16px 9px;
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
            width: 15%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 11%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 12%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 21%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 12%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 29%;
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

        .level-name {
            color: var(--pink);
            font-weight: 750;
        }

        .fee {
            color: var(--green);
            font-weight: 750;
        }

        .benefits {
            color: var(--muted);
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .status.active {
            background: rgba(114, 214, 155, .13);
            color: var(--green);
        }

        .status.inactive {
            background: rgba(240, 141, 168, .13);
            color: #f08da8;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 5px;
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
            height: 36px;
            padding: 0 8px;
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
            width: 55px;
            background: rgba(120, 201, 221, .13);
            color: var(--blue);
        }

        .view-button:hover {
            background: rgba(120, 201, 221, .23);
        }

        .edit-button {
            width: 55px;
            background: rgba(229, 164, 93, .13);
            color: var(--orange);
        }

        .edit-button:hover {
            background: rgba(229, 164, 93, .23);
        }

        .deactivate-button,
        .activate-button {
            width: 88px;
        }

        .deactivate-button {
            background: rgba(240, 141, 168, .13);
            color: #f08da8;
        }

        .deactivate-button:hover {
            background: rgba(240, 141, 168, .25);
        }

        .activate-button {
            background: rgba(114, 214, 155, .13);
            color: var(--green);
        }

        .activate-button:hover {
            background: rgba(114, 214, 155, .25);
        }

        .delete-button {
            width: 60px;
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

        @media (max-width: 1200px) {
            .main {
                padding: 30px 25px 50px;
            }

            th,
            td {
                padding: 14px 6px;
            }

            .action-button {
                padding: 0 6px;
                font-size: 10px;
            }

            .view-button,
            .edit-button {
                width: 50px;
            }

            .deactivate-button,
            .activate-button {
                width: 80px;
            }

            .delete-button {
                width: 54px;
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
                min-width: 900px;
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
                <h1>Membership Levels</h1>

                <p>
                    Manage membership packages, fees, and benefits.
                </p>
            </div>

            <a
                href="{{ route('membership-levels.create') }}"
                class="add-button"
            >
                + Add Level
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
                action="{{ route('membership-levels.index') }}"
                method="GET"
                class="search-form"
            >
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    value="{{ $search ?? '' }}"
                    placeholder="Search level or benefits..."
                >

                <button
                    type="submit"
                    class="button search-button"
                >
                    Search
                </button>

                <a
                    href="{{ route('membership-levels.index') }}"
                    class="button clear-button"
                >
                    Clear
                </a>
            </form>

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Level Name</th>
                            <th>Fee</th>
                            <th>Validity</th>
                            <th>Benefits</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($levels as $level)

                            <tr>
                                <td class="level-name">
                                    {{ $level->name }}
                                </td>

                                <td class="fee">
                                    ₱{{ number_format($level->fee, 2) }}
                                </td>

                                <td>
                                    {{ $level->validity_period_months }}
                                    month(s)
                                </td>

                                <td class="benefits">
                                    {{
                                        $level->benefits
                                        ?? 'No benefits listed'
                                    }}
                                </td>

                                <td>
                                    @if ($level->is_active)
                                        <span class="status active">
                                            Active
                                        </span>
                                    @else
                                        <span class="status inactive">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('membership-levels.show', $level) }}"
                                            class="action-button view-button"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('membership-levels.edit', $level) }}"
                                            class="action-button edit-button"
                                        >
                                            Edit
                                        </a>

                                        @if ($level->is_active)

                                            <form
                                                action="{{ route('membership-levels.deactivate', $level) }}"
                                                method="POST"
                                                onsubmit="return confirm('Deactivate this membership level?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="action-button deactivate-button"
                                                >
                                                    Deactivate
                                                </button>
                                            </form>

                                        @else

                                            <form
                                                action="{{ route('membership-levels.activate', $level) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="action-button activate-button"
                                                >
                                                    Activate
                                                </button>
                                            </form>

                                        @endif

                                        <form
                                            action="{{ route('membership-levels.destroy', $level) }}"
                                            method="POST"
                                            onsubmit="return confirm('Permanently delete this membership level?')"
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
                                    colspan="6"
                                    class="empty-message"
                                >
                                    No membership levels found.
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