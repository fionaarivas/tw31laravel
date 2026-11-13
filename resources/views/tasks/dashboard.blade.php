<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Task Dashboard</title>

    <style>
        :root {
            --background: #151219;
            --panel: #1c1821;
            --panel-light: #29222f;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --pink-dark: #c967a8;
            --purple: #a984df;
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
                    circle at 82% 0%,
                    rgba(142, 81, 157, .22),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #000000 0%,
                    #6e5c64 52%,
                    #050505 100%
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
            padding: 30px 38px 55px;
        }

        .page-header {
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

        .page-header h1 {
            margin: 0;
            color: var(--text);
            font-size: 35px;
            letter-spacing: -.8px;
        }

        .subtitle {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .assigned-button {
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

        .assigned-button:hover {
            background: var(--pink-dark);
            transform: translateY(-2px);
        }

        .content-card,
        .task-list-card,
        .stat-card {
            border: 1px solid var(--border);
            background: rgba(24, 21, 28, .95);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .22);
        }

        .content-card {
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
            padding: 31px 36px;
            border-radius: 20px;
        }

        .content-card::after {
            position: absolute;
            right: -55px;
            top: -90px;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(233, 132, 197, .15);
            content: "";
        }

        .content-card h2,
        .content-card p {
            position: relative;
            z-index: 1;
        }

        .content-card h2 {
            margin: 0 0 11px;
            color: var(--text);
            font-size: 25px;
        }

        .content-card p {
            max-width: 780px;
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            min-height: 142px;
            padding: 23px;
            border-radius: 17px;
            transition: .2s ease;
        }

        .stat-card:hover {
            border-color: rgba(233, 132, 197, .4);
            transform: translateY(-3px);
        }

        .stat-card::before {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--pink);
            content: "";
        }

        .stat-card:nth-child(2)::before {
            background: var(--orange);
        }

        .stat-card:nth-child(3)::before {
            background: var(--green);
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
            width: 35px;
            height: 35px;
            place-items: center;
            border: 1px solid rgba(233, 132, 197, .24);
            border-radius: 11px;
            background: rgba(233, 132, 197, .1);
            color: var(--pink);
            font-weight: 800;
        }

        .stat-card:nth-child(2) .stat-icon {
            border-color: rgba(229, 164, 93, .25);
            background: rgba(229, 164, 93, .1);
            color: var(--orange);
        }

        .stat-card:nth-child(3) .stat-icon {
            border-color: rgba(114, 214, 155, .25);
            background: rgba(114, 214, 155, .1);
            color: var(--green);
        }

        .stat-value {
            margin-top: 18px;
            color: var(--pink);
            font-size: 31px;
            font-weight: 800;
        }

        .stat-card:nth-child(2) .stat-value {
            color: var(--orange);
        }

        .stat-card:nth-child(3) .stat-value {
            color: var(--green);
        }

        .task-list-card {
            padding: 28px 30px 24px;
            border-radius: 20px;
        }

        .task-list-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .task-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .task-heading-icon {
            display: grid;
            width: 39px;
            height: 39px;
            place-items: center;
            border-radius: 11px;
            background: rgba(233, 132, 197, .12);
            color: var(--pink);
            font-weight: 800;
        }

        .task-list-header h2 {
            margin: 0;
            color: var(--text);
            font-size: 23px;
        }

        .task-list-header p {
            margin: 5px 0 0;
            color: var(--muted);
            line-height: 1.6;
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
            padding: 16px 13px;
            border-bottom: 1px solid rgba(255, 255, 255, .09);
            text-align: left;
        }

        th {
            color: #948b99;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            color: #d9d1dc;
            font-size: 13px;
            vertical-align: top;
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

        td:first-child {
            color: var(--text);
            font-weight: 700;
        }

        td:nth-child(3) {
            color: var(--pink);
            font-weight: 700;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
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

        .status.pending {
            background: rgba(229, 164, 93, .13);
            color: var(--orange);
        }

        .status.completed {
            background: rgba(114, 214, 155, .13);
            color: var(--green);
        }

        .empty-task {
            padding: 35px;
            border: 1px dashed rgba(255, 255, 255, .18);
            border-radius: 13px;
            background: rgba(255, 255, 255, .025);
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 1000px) {
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

            .page-header h1 {
                font-size: 31px;
            }

            .assigned-button {
                width: 100%;
            }

            .content-card {
                padding: 27px 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .task-list-card {
                padding: 22px 18px;
            }

            .task-list-header {
                align-items: flex-start;
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

                <h1>Task Dashboard</h1>

                <p class="subtitle">
                    Monitor and manage member tasks.
                </p>
            </div>

            <a
                href="{{ route('tasks.index') }}"
                class="assigned-button"
            >
                + Assigned Tasks
            </a>
        </header>

        <section class="content-card">
            <h2>Task Management</h2>

            <p>
                Create, assign, and monitor tasks for your members
                from one organized workspace.
            </p>
        </section>

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">
                        Total Tasks
                    </div>

                    <div class="stat-icon">
                        T
                    </div>
                </div>

                <div class="stat-value">
                    {{ $totalTasks }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">
                        Pending Tasks
                    </div>

                    <div class="stat-icon">
                        !
                    </div>
                </div>

                <div class="stat-value">
                    {{ $pendingTasks }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-label">
                        Completed Tasks
                    </div>

                    <div class="stat-icon">
                        ✓
                    </div>
                </div>

                <div class="stat-value">
                    {{ $completedTasks }}
                </div>
            </div>

        </section>

        <section class="task-list-card">

            <div class="task-list-header">
                <div class="task-heading">
                    <div class="task-heading-icon">
                        T
                    </div>

                    <div>
                        <h2>Assigned Tasks</h2>

                        <p>
                            Tasks assigned to each member.
                        </p>
                    </div>
                </div>
            </div>

            @if ($tasks->count())

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Task Title</th>
                                <th>Description</th>
                                <th>Assigned Member</th>
                                <th>Membership No.</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        {{ $task->task_title }}
                                    </td>

                                    <td>
                                        {{
                                            $task->description
                                            ?: 'No description'
                                        }}
                                    </td>

                                    <td>
                                        {{
                                            $task->member?->name
                                            ?? 'Unassigned'
                                        }}
                                    </td>

                                    <td>
                                        {{
                                            $task->member?->membership_number
                                            ?? '—'
                                        }}
                                    </td>

                                    <td>
                                        @if ($task->completed)
                                            <span class="status completed">
                                                Completed
                                            </span>
                                        @else
                                            <span class="status pending">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else

                <div class="empty-task">
                    No tasks have been assigned yet.
                </div>

            @endif

        </section>

    </main>

</div>

</body>
</html>