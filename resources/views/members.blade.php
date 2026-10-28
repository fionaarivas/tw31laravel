<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Members</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263238;
        }

        .navbar {
            background: #1f3c88;
            padding: 18px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2,
        .navbar a {
            color: white;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .container {
            width: 92%;
            max-width: 1300px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            color: #1f3c88;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
        }

        .button,
        button {
            border: none;
            border-radius: 7px;
            padding: 10px 15px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .primary {
            background: #1f3c88;
            color: white;
        }

        .secondary {
            background: #e5e7eb;
            color: #263238;
        }

        .view {
            background: #2563eb;
            color: white;
        }

        .edit {
            background: #d97706;
            color: white;
        }

        .danger {
            background: #dc2626;
            color: white;
        }

        .search-box {
            margin: 25px 0;
            display: flex;
            gap: 10px;
        }

        .search-box input {
            width: 350px;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1150px;
        }

        th {
            background: #1f3c88;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background: #f8fafc;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .actions form {
            display: inline;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #6b7280;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <h2>Membership System</h2>

    <div>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('members.index') }}">Members</a>
    </div>
</nav>

<main class="container">

    <div class="header">
        <div>
            <h1>Members</h1>
            <p class="subtitle">
                Manage registered members and membership information
            </p>
        </div>

        <a href="{{ route('members.create') }}" class="button primary">
            + Add Member
        </a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('members.index') }}" method="GET" class="search-box">
        <input
            type="text"
            name="search"
            placeholder="Search by name, category, or level"
            value="{{ $search ?? '' }}"
        >

        <button type="submit" class="primary">
            Search
        </button>

        <a href="{{ route('members.index') }}" class="button secondary">
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
                            <th>Phone</th>
                            <th>Category</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
            @endif

                        <tr>
                            <td>{{ $member->membership_number }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->phone_number }}</td>
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
                                            action="{{ route('members.destroy', $member) }}"
                                            method="POST"
                                            onsubmit="return confirm('Deactivate this member?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="danger">
                                                Deactivate
                                            </button>
                                        </form>
                                    @endif
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

</body>
</html>