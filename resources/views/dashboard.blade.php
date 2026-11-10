<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7faf9;
            color: #193b35;
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
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 245px;
            min-height: 100vh;
            padding: 28px 17px;
            background: #193b35;
            color: white;
        }

        .brand {
            padding: 8px 13px 28px;
            border-bottom: 1px solid rgba(255, 255, 255, .16);
            font-size: 23px;
            font-weight: 700;
        }

        .brand span {
            color: #e875a8;
        }

        .menu-title {
            margin: 34px 12px 14px;
            color: #b5d0c7;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-link {
            display: block;
            margin-bottom: 5px;
            padding: 13px 14px;
            border-radius: 9px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #e875a8;
            color: white;
        }

        .logout-form {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, .16);
        }

        .logout-button {
            width: 100%;
            border: none;
            border-radius: 9px;
            padding: 13px 14px;
            background: transparent;
            color: white;
            text-align: left;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #b83e64;
        }

        .main {
            flex: 1;
            margin-left: 245px;
            padding: 38px 52px 60px;
        }

        .page-header {
            margin-bottom: 36px;
        }

        h1 {
            margin: 0;
            font-size: 36px;
            letter-spacing: -1px;
        }

        .subtitle {
            margin-top: 10px;
            color: #66807b;
            font-size: 16px;
        }

        .welcome-card {
            margin-bottom: 25px;
            padding: 34px;
            border: 1px solid #dce9df;
            border-radius: 18px;
            background: white;
            box-shadow: 0 8px 24px rgba(25, 59, 53, .05);
        }

        .welcome-card h2 {
            margin: 0;
            font-size: 29px;
        }

        .welcome-card h2 span {
            color: #e875a8;
        }

        .welcome-card p {
            max-width: 750px;
            margin: 14px 0 0;
            color: #66807b;
            line-height: 1.7;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            padding: 24px 22px;
            border: 1px solid #dce9df;
            border-radius: 15px;
            background: white;
            box-shadow: 0 8px 20px rgba(25, 59, 53, .04);
        }

        .stat-label {
            color: #66807b;
            font-size: 13px;
            font-weight: 600;
        }

        .stat-value {
            margin-top: 15px;
            color: #e875a8;
            font-size: 29px;
            font-weight: 700;
        }

        .stat-card:nth-child(2) .stat-value {
            color: #337a4b;
        }

        .stat-card:nth-child(3) .stat-value {
            color: #a8631b;
        }

        .content-card {
            padding: 28px;
            border: 1px solid #dce9df;
            border-radius: 18px;
            background: white;
            box-shadow: 0 8px 24px rgba(25, 59, 53, .05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 22px;
        }

        .view-all {
            color: #e875a8;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .view-all:hover {
            color: #d95f94;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 12px;
            border-bottom: 1px solid #e5ece8;
            text-align: left;
        }

        th {
            color: #71807a;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            color: #26332f;
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #e2f4e4;
            color: #337a4b;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status.inactive {
            background: #fff0f4;
            color: #b83e64;
        }

        .empty-message {
            padding: 25px;
            border-radius: 10px;
            background: #f8fbf9;
            color: #71807a;
            text-align: center;
        }

        @media (max-width: 1000px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .main {
                padding: 30px;
            }
        }

        @media (max-width: 700px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .main {
               margin-left: 0;
               padding: 25px 18px 45px;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-card,
            .content-card {
                padding: 22px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">

        <header class="page-header">
            <h1>Dashboard</h1>

            <p class="subtitle">
                Membership Management and Transaction Processing System
            </p>
        </header>

        <section class="welcome-card">

            <h2>
                Welcome to
                <span>membership dashboard</span>
            </h2>

            <p>
                Manage member registration, membership levels, transactions,
                and payment records in one organized system.
            </p>

        </section>

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-label">
                    Total Members
                </div>

                <div class="stat-value">
                    {{ $totalMembers }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Active Members
                </div>

                <div class="stat-value">
                    {{ $activeMembers }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Pending Transactions
                </div>

                <div class="stat-value">
                    {{ $pendingTransactions }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Collected Payments
                </div>

                <div class="stat-value">
                    ₱{{ number_format($collectedPayments, 2) }}
                </div>
            </div>

        </section>

        <section class="content-card">

            <div class="card-header">
                <h2>Recent Members</h2>

                <a
                    href="{{ route('members.index') }}"
                    class="view-all"
                >
                    View All
                </a>
            </div>

            @if ($recentMembers->count())

                <div class="table-wrapper">
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
                            @foreach ($recentMembers as $member)
                                <tr>
                                    <td>
                                        {{ $member->membership_number }}
                                    </td>

                                    <td>
                                        {{ $member->name }}
                                    </td>

                                    <td>
                                        {{ $member->membershipCategory?->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $member->membershipLevel?->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="status {{ $member->status }}">
                                            {{ $member->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else

                <div class="empty-message">
                    No members found.
                </div>

            @endif

        </section>

    </main>

</div>

</body>
</html>