<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <style>
        :root {
            --background: #17141b;
            --panel: #211c27;
            --panel-light: #29232f;
            --border: rgba(255, 255, 255, .13);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --purple: #ad88df;
            --green: #72d69b;
            --orange: #e5a45d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 86% 0%,
                    rgba(133, 82, 145, .15),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #17141b 0%,
                    #3d3540 55%,
                    #211b27 100%
                );
            color: var(--text);
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 34px 42px 60px;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 25px;
            max-width: 1500px;
            margin: 0 auto 27px;
        }

        .page-header h1 {
            margin: 0;
            color: var(--text);
            font-size: 35px;
            line-height: 1.1;
            letter-spacing: -.8px;
        }

        .subtitle {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .admin-badge {
            padding: 10px 17px;
            border: 1px solid rgba(233, 132, 197, .45);
            border-radius: 999px;
            background: rgba(233, 132, 197, .07);
            color: var(--pink);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .welcome-card {
            position: relative;
            overflow: hidden;
            max-width: 1500px;
            min-height: 190px;
            margin: 0 auto 21px;
            padding: 35px 45px;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 22px;
            background:
                linear-gradient(
                    125deg,
                    #302934 0%,
                    #29232f 58%,
                    #362c3b 100%
                );
            box-shadow: 0 8px 22px rgba(0, 0, 0, .10);
        }

        .welcome-card::after {
            position: absolute;
            right: -110px;
            top: -160px;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: radial-gradient(
                circle,
                rgba(233, 132, 197, .25),
                rgba(142, 81, 157, .08) 55%,
                transparent 72%
            );
            content: "";
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .welcome-label {
            margin-bottom: 15px;
            color: var(--pink);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .welcome-card h2 {
            margin: 0;
            color: var(--text);
            font-size: 32px;
            line-height: 1.2;
            letter-spacing: -.7px;
        }

        .welcome-card h2 span {
            color: var(--pink);
        }

        .welcome-card p {
            max-width: 760px;
            margin: 15px 0 0;
            color: #d3cbd6;
            font-size: 14px;
            line-height: 1.7;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            max-width: 1500px;
            margin: 0 auto 22px;
        }

        .stat-card {
            position: relative;
            min-height: 145px;
            padding: 23px 23px 21px 25px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 18px;
            background: #211c27;
            box-shadow: 0 7px 18px rgba(0, 0, 0, .10);
            transition: .2s ease;
        }

        .stat-card:hover {
            border-color: rgba(233, 132, 197, .35);
            transform: translateY(-2px);
        }

        .stat-card::before {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 18px 0 0 18px;
            background: var(--pink);
            content: "";
        }

        .stat-card:nth-child(2)::before {
            background: var(--green);
        }

        .stat-card:nth-child(3)::before {
            background: var(--orange);
        }

        .stat-card:nth-child(4)::before {
            background: var(--purple);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .stat-icon {
            display: grid;
            width: 39px;
            height: 39px;
            place-items: center;
            border: 1px solid rgba(233, 132, 197, .25);
            border-radius: 12px;
            background: rgba(233, 132, 197, .1);
            color: var(--pink);
            font-weight: 800;
        }

        .stat-card:nth-child(2) .stat-icon {
            border-color: rgba(114, 214, 155, .25);
            background: rgba(114, 214, 155, .1);
            color: var(--green);
        }

        .stat-card:nth-child(3) .stat-icon {
            border-color: rgba(229, 164, 93, .25);
            background: rgba(229, 164, 93, .1);
            color: var(--orange);
        }

        .stat-card:nth-child(4) .stat-icon {
            border-color: rgba(173, 136, 223, .25);
            background: rgba(173, 136, 223, .1);
            color: var(--purple);
        }

        .stat-value {
            margin-top: 20px;
            color: var(--pink);
            font-size: 31px;
            font-weight: 800;
        }

        .stat-card:nth-child(2) .stat-value {
            color: var(--green);
        }

        .stat-card:nth-child(3) .stat-value {
            color: var(--orange);
        }

        .stat-card:nth-child(4) .stat-value {
            color: var(--purple);
            font-size: 25px;
        }

        .content-card {
            max-width: 1500px;
            margin: 0 auto;
            padding: 27px 31px 23px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 20px;
            background: #1c1821;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .10);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            display: grid;
            width: 39px;
            height: 39px;
            place-items: center;
            border-radius: 12px;
            background: rgba(233, 132, 197, .12);
            color: var(--pink);
            font-weight: 800;
        }

        .card-header h2 {
            margin: 0;
            color: var(--text);
            font-size: 22px;
        }

        .view-all {
            color: var(--pink);
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        .view-all:hover {
            color: #ffb4df;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            text-align: left;
        }

        th {
            color: #9f95a4;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            color: #d9d1dc;
            font-size: 13px;
        }

        tbody tr {
            transition: .2s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, .025);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .member-number {
            color: var(--pink);
            font-weight: 800;
        }

        .member-name {
            color: var(--text);
            font-weight: 700;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 11px;
            border-radius: 999px;
            background: rgba(114, 214, 155, .13);
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
        }

        .status::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .status.inactive {
            background: rgba(240, 141, 168, .13);
            color: #f08da8;
        }

        .empty-message {
            padding: 30px;
            border: 1px dashed rgba(255, 255, 255, .18);
            border-radius: 13px;
            background: rgba(255, 255, 255, .025);
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 1150px) {
            .main {
                padding: 30px 27px 50px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .layout {
                display: block;
            }

            .main {
                padding: 25px 17px 40px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-badge {
                display: none;
            }

            .welcome-card {
                padding: 29px 24px;
            }

            .welcome-card h2 {
                font-size: 27px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .content-card {
                padding: 22px 17px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            th,
            td {
                padding: 13px 10px;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">

        <header class="page-header">
            <div>
                <h1>Dashboard</h1>

                <p class="subtitle">
                    Membership Management and Transaction Processing System
                </p>
            </div>

            <div class="admin-badge">
                Admin Overview
            </div>
        </header>

        <section class="welcome-card">
            <div class="welcome-content">
                <div class="welcome-label">
                    Membership workspace
                </div>

                <h2>
                    Welcome to
                    <span>membership dashboard</span>
                </h2>

                <p>
                    Manage member registration, membership levels,
                    transactions, and payment records in one organized system.
                </p>
            </div>
        </section>

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">Total Members</div>
                    <div class="stat-icon">M</div>
                </div>

                <div class="stat-value">
                    {{ $totalMembers }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">Active Members</div>
                    <div class="stat-icon">✓</div>
                </div>

                <div class="stat-value">
                    {{ $activeMembers }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">Pending Transactions</div>
                    <div class="stat-icon">!</div>
                </div>

                <div class="stat-value">
                    {{ $pendingTransactions }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">Collected Payments</div>
                    <div class="stat-icon">₱</div>
                </div>

                <div class="stat-value">
                    ₱{{ number_format($collectedPayments, 2) }}
                </div>
            </div>

        </section>

        <section class="content-card">

            <div class="card-header">
                <div class="card-heading">
                    <div class="card-icon">M</div>

                    <h2>Recent Members</h2>
                </div>

                <a
                    href="{{ route('members.index') }}"
                    class="view-all"
                >
                    View All →
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
                                        <span class="member-number">
                                            {{ $member->membership_number }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="member-name">
                                            {{ $member->name }}
                                        </span>
                                    </td>

                                    <td>
                                        {{
                                            $member->membershipCategory?->name
                                            ?? 'N/A'
                                        }}
                                    </td>

                                    <td>
                                        {{
                                            $member->membershipLevel?->name
                                            ?? 'N/A'
                                        }}
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