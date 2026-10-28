<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Membership System</title>

    <style>
        :root {
            --background: #f8faf9;
            --sidebar: #193b35;
            --sidebar-hover: #28584e;
            --white: #ffffff;
            --pink: #e875a8;
            --pink-hover: #d95f94;
            --green: #86c98b;
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

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .topbar h1 {
            margin: 0;
            color: var(--text);
            font-size: 34px;
        }

        .topbar p {
            margin-top: 10px;
            color: var(--muted);
        }

        .date {
            color: var(--muted);
            font-size: 14px;
        }

        .hero {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 32px;
            border-radius: 18px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(34, 70, 55, 0.06);
        }

        .hero h2 {
            margin: 0;
            font-size: 31px;
            color: var(--text);
        }

        .hero h2 span {
            color: var(--pink);
        }

        .hero p {
            color: var(--muted);
            line-height: 1.6;
            max-width: 720px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(34, 70, 55, 0.06);
        }

        .stat-card h3 {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .stat-number {
            margin-top: 15px;
            color: var(--pink);
            font-size: 30px;
            font-weight: bold;
        }

        .stat-card:nth-child(2) .stat-number {
            color: var(--green-dark);
        }

        .stat-card:nth-child(3) .stat-number {
            color: #8b6b35;
        }

        .content-card {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(34, 70, 55, 0.06);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .section-header h2 {
            margin: 0;
            color: var(--text);
        }

        .view-all {
            color: var(--pink);
            text-decoration: none;
            font-weight: bold;
        }

        .view-all:hover {
            color: var(--pink-hover);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
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
            background: #e2f4e4;
            color: var(--green-dark);
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            color: var(--muted);
            padding: 20px 0;
        }

        @media (max-width: 1050px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
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

            .topbar {
                display: block;
            }

            .date {
                display: block;
                margin-top: 12px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .hero h2 {
                font-size: 26px;
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
            <a href="{{ route('dashboard') }}" class="active">
                 Dashboard
            </a>

            <a href="{{ route('members.index') }}">
                 Members
            </a>

        </nav>

        <div class="menu-title">Management</div>

        <nav class="menu">
            <a href="#" class="disabled"> Categories</a>
            <a href="#" class="disabled"> Membership Levels</a>
            <a href="#" class="disabled"> Transactions</a>
            <a href="#" class="disabled"> Payments</a>
        </nav>
    </aside>

    <main class="main">

        <div class="topbar">
            <div>
                <h1>Dashboard</h1>
                <p>Membership Management and Transaction Processing System</p>
            </div>

        </div>

        <section class="hero">
            <h2>
                Welcome to your <span>membership dashboard</span>
            </h2>

            <p>
                Manage member registration, membership levels, transactions,
                and payment records in one organized system.
            </p>
        </section>

        <section class="cards">
            <div class="stat-card">
                <h3>Total Members</h3>
                <div class="stat-number">
                    {{ $totalMembers }}
                </div>
            </div>

            <div class="stat-card">
                <h3>Active Members</h3>
                <div class="stat-number">
                    {{ $activeMembers }}
                </div>
            </div>

            <div class="stat-card">
                <h3>Pending Transactions</h3>
                <div class="stat-number">
                    {{ $pendingTransactions }}
                </div>
            </div>

            <div class="stat-card">
                <h3>Collected Payments</h3>
                <div class="stat-number">
                    ₱{{ number_format($collectedPayments, 2) }}
                </div>
            </div>
        </section>

        <section class="content-card">
            <div class="section-header">
                <h2>Recent Members</h2>

                <a href="{{ route('members.index') }}" class="view-all">
                    View All
                </a>
            </div>

            <div class="table-wrapper">
                @forelse ($recentMembers as $member)

                    @if ($loop->first)
                        <table>
                            <thead>
                                <tr>
                                    <th>Membership No.</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                    @endif

                                <tr>
                                    <td>{{ $member->membership_number }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>
                                        {{ $member->membershipCategory?->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $member->membershipLevel?->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <span class="status">
                                            {{ ucfirst($member->status) }}
                                        </span>
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
        </section>

    </main>

</div>

</body>
</html>