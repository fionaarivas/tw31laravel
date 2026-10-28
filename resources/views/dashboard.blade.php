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

        .navbar h2 {
            margin: 0;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .container {
            width: 88%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .heading h1 {
            margin-bottom: 8px;
            color: #1f3c88;
        }

        .heading p {
            color: #6b7280;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin: 0;
            color: #6b7280;
            font-size: 16px;
        }

        .card .number {
            margin-top: 15px;
            font-size: 32px;
            font-weight: bold;
            color: #1f3c88;
        }

        .card:nth-child(2) .number {
            color: #15803d;
        }

        .card:nth-child(3) .number {
            color: #d97706;
        }

        .card:nth-child(4) .number {
            color: #7c3aed;
        }

        .quick-links {
            margin-top: 35px;
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .quick-links h2 {
            margin-top: 0;
            color: #1f3c88;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .links a {
            background: #1f3c88;
            color: white;
            padding: 12px 18px;
            border-radius: 7px;
            text-decoration: none;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                display: block;
            }

            .navbar a {
                display: inline-block;
                margin: 12px 12px 0 0;
            }
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
        <section class="heading">
            <h1>Dashboard</h1>
            <p>Membership Management and Transaction Processing System</p>
        </section>

        <section class="cards">
            <div class="card">
                <h3>Total Members</h3>
                <div class="number">{{ $totalMembers }}</div>
            </div>

            <div class="card">
                <h3>Active Members</h3>
                <div class="number">{{ $activeMembers }}</div>
            </div>

            <div class="card">
                <h3>Pending Transactions</h3>
                <div class="number">{{ $pendingTransactions }}</div>
            </div>

            <div class="card">
                <h3>Collected Payments</h3>
                <div class="number">
                    ₱{{ number_format($collectedPayments, 2) }}
                </div>
            </div>
        </section>

        <section class="quick-links">
            <h2>Quick Links</h2>

            <div class="links">
                <a href="{{ route('members.index') }}">
                    View Members
                </a>

                <a href="{{ route('members.create') }}">
                    Register New Member
                </a>
            </div>
        </section>
    </main>

</body>
</html>