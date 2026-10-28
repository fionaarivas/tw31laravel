<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Members | Membership System</title>

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
        h4,
        button,
        input,
        select,
        textarea {
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
            font-weight: bold;
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
        }

        .menu a:hover,
        .menu a.active {
            background: var(--pink);
            color: white;
            font-weight: bold;
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .page-header h1 {
            margin: 0;
            color: var(--text);
            font-size: 34px;
        }

        .page-header p {
            color: var(--muted);
            margin-top: 10px;
        }

        .add-button,
        .button {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .add-button {
            background: var(--pink);
            color: white;
            padding: 12px 17px;
        }

        .add-button:hover {
            background: var(--pink-hover);
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-box input {
            width: 360px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: white;
        }

        .primary {
            background: var(--pink);
            color: white;
        }

        .primary:hover {
            background: var(--pink-hover);
        }

        .secondary {
            background: #e7efea;
            color: var(--text);
        }

        .success {
            background: #e2f4e4;
            color: var(--green-dark);
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(34, 70, 55, 0.06);
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
            padding: 14px 13px;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        tr:hover {
            background: #fff7fa;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .active {
            background: #e2f4e4;
            color: var(--green-dark);
        }

        .inactive {
            background: #fde4ed;
            color: #a23a63;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .actions form {
            display: inline;
        }

        .view {
            background: #dcecf0;
            color: #27616b;
        }

        .edit {
            background: #fff0d8;
            color: #946326;
        }

        .deactivate {
            background: #fde4ed;
            color: #a23a63;
        }

        .activate {
            background: #e2f4e4;
            color: var(--green-dark);
        }

        .delete {
            background: #f8d7df;
            color: #9f2e58;
        }

        .empty {
            color: var(--muted);
            text-align: center;
            padding: 25px;
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 205px;
            }

            .main {
                width: calc(100% - 205px);
                margin-left: 205px;
                padding: 25px 18px;
            }

            .page-header {
                display: block;
            }

            .add-button {
                display: inline-block;
                margin-top: 15px;
            }
        }

        @media (max-width: 600px) {
            .search-box {
                display: block;
            }

            .search-box input {
                width: 100%;
                margin-bottom: 10px;
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

        <div class="menu-title">Main Menu</div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}">
                 Dashboard
            </a>

            <a href="{{ route('members.index') }}" class="active">
                 Members
            </a>
        </nav>

        <div class="menu-title">Management</div>

        <nav class="menu">
            <a href="#" class="disabled">
                 Categories
            </a>

            <a href="#" class="disabled">
                 Membership Levels
            </a>

            <a href="#" class="disabled">
                 Transactions
            </a>

            <a href="#" class="disabled">
                 Payments
            </a>
        </nav>
    </aside>

    <main class="main">

        <div class="page-header">
            <div>
                <h1>Members</h1>
                <p>Manage registered members and membership information.</p>
            </div>

            <a
                href="{{ route('members.create') }}"
                class="add-button"
            >
                + Add New Member
            </a>
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form
            action="{{ route('members.index') }}"
            method="GET"
            class="search-box"
        >
            <input
                type="text"
                name="search"
                placeholder="Search by name, category, or level"
                value="{{ $search ?? '' }}"
            >

            <button type="submit" class="button primary">
                Search
            </button>

            <a
                href="{{ route('members.index') }}"
                class="button secondary"
            >
                Clear
            </a>
        </form>

        <div class="card">
            @forelse ($members as $member)

                @if ($loop->first)
                    <table>
                        <thead>
                            <tr>
                                <th>Membership No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Category</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                @endif

                            <tr>
                                <td>
                                    {{ $member->membership_number }}
                                </td>

                                <td>
                                    {{ $member->name }}
                                </td>

                                <td>
                                    {{ $member->email }}
                                </td>

                                <td>
                                    {{ $member->membershipCategory?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $member->membershipLevel?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    <span class="status {{ $member->status }}">
                                        {{ ucfirst($member->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('members.show', $member) }}"
                                            class="button view"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('members.edit', $member) }}"
                                            class="button edit"
                                        >
                                            Edit
                                        </a>

                                        @if ($member->status === 'active')

                                            <form
                                                action="{{ route('members.deactivate', $member) }}"
                                                method="POST"
                                                onsubmit="return confirm('Deactivate this member?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="button deactivate"
                                                >
                                                    Deactivate
                                                </button>
                                            </form>

                                        @else

                                            <form
                                                action="{{ route('members.activate', $member) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="button activate"
                                                >
                                                    Activate
                                                </button>
                                            </form>

                                        @endif

                                        <form
                                            action="{{ route('members.destroy', $member) }}"
                                            method="POST"
                                            onsubmit="return confirm('Permanently delete this member?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="button delete"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                @if ($loop->last)
                        </tbody>
                    </table>
                @endif

            @empty

                <div class="empty">
                    No members found.
                </div>

            @endforelse
        </div>

    </main>

</div>

</body>
</html>