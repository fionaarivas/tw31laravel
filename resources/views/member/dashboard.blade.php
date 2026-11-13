@php
    $totalTasks = $tasks->count();
    $completedTasks = $tasks->where('completed', true)->count();
    $pendingTasks = $tasks->where('completed', false)->count();

    $progress = $totalTasks > 0
        ? round(($completedTasks / $totalTasks) * 100)
        : 0;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Member Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --green: #123f38;
            --dark-green: #063d3b;
            --pink: #e875a8;
            --soft-pink: #fce3ef;
            --text: #193b35;
            --muted: #66807b;
            --border: #dce9df;
            --bg: #f7faf9;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 8%;
            background: var(--green);
        }

        .logo {
            color: white;
            font-size: 27px;
            font-weight: 700;
        }

        .logo span {
            color: var(--pink);
        }

        .logout-button {
            padding: 11px 22px;
            border: none;
            border-radius: 9px;
            background: var(--pink);
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .logout-button:hover {
            background: #d95f94;
            transform: translateY(-2px);
        }

        .container {
            width: 90%;
            max-width: 1050px;
            margin: 42px auto 70px;
        }

        .success-message {
            margin-bottom: 22px;
            padding: 14px 18px;
            border: 1px solid #b8dfc2;
            border-radius: 10px;
            background: #e2f5e6;
            color: #28733f;
            transition: .5s ease;
        }

        .success-message.hide {
            opacity: 0;
            transform: translateY(-8px);
        }

        .hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
            padding: 38px 42px;
            border-radius: 22px;
            background: linear-gradient(
                135deg,
                #123f38,
                #216b5e
            );
            color: white;
            box-shadow: 0 12px 30px rgba(18, 63, 56, .18);
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            right: -70px;
            top: -100px;
            border-radius: 50%;
            background: rgba(232, 117, 168, .25);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            margin: 0 0 12px;
            font-size: 36px;
        }

        .hero p {
            margin: 8px 0;
            color: #dceee8;
            font-size: 16px;
        }

        .membership-number {
            color: #ffd1e4;
            font-weight: 700;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 25px;
        }

        .stat-card {
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: white;
            box-shadow: 0 8px 20px rgba(25, 59, 53, .05);
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        .stat-number {
            margin-top: 8px;
            color: var(--dark-green);
            font-size: 30px;
            font-weight: 800;
        }

        .stat-card:nth-child(2) .stat-number {
            color: #b36a1d;
        }

        .stat-card:nth-child(3) .stat-number {
            color: #337a4b;
        }

        .tasks-card {
            padding: 32px 40px 38px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 28px rgba(25, 59, 53, .06);
        }

        .tasks-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 18px;
        }

        .tasks-header h2 {
            margin: 0;
            color: var(--dark-green);
            font-size: 27px;
        }

        .task-count {
            padding: 8px 14px;
            border-radius: 20px;
            background: var(--soft-pink);
            color: #c84d86;
            font-size: 13px;
            font-weight: 700;
        }

        .progress-wrapper {
            margin-bottom: 24px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 13px;
        }

        .progress-bar {
            height: 9px;
            overflow: hidden;
            border-radius: 20px;
            background: #edf3ef;
        }

        .progress-fill {
            height: 100%;
            width: {{ $progress }}%;
            border-radius: 20px;
            background: linear-gradient(
                90deg,
                #e875a8,
                #337a4b
            );
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 15px;
            padding: 23px;
            border: 1px solid #e0ebe5;
            border-radius: 15px;
            background: #f9fcfa;
            transition: .2s;
        }

        .task-item:hover {
            border-color: #bcd6c7;
            box-shadow: 0 7px 18px rgba(25, 59, 53, .08);
            transform: translateY(-2px);
        }

        .task-details {
            flex: 1;
        }

        .task-title {
            margin: 0 0 8px;
            color: var(--dark-green);
            font-size: 19px;
        }

        .task-description {
            margin: 0 0 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        .task-status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-pending {
            background: #fff0d5;
            color: #a8631b;
        }

        .status-completed {
            background: #dff3e5;
            color: #337a4b;
        }

        .complete-button {
            padding: 11px 17px;
            border: none;
            border-radius: 9px;
            background: #337a4b;
            color: white;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .complete-button:hover {
            background: #28633c;
            transform: translateY(-2px);
        }

        .empty-state {
            padding: 35px;
            border: 1px dashed #cbded1;
            border-radius: 14px;
            background: #f7fbf8;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 700px) {
            .topbar {
                padding: 20px;
            }

            .logo {
                font-size: 23px;
            }

            .container {
                width: 94%;
                margin-top: 28px;
            }

            .hero {
                padding: 30px 25px;
            }

            .hero h1 {
                font-size: 29px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .tasks-card {
                padding: 25px;
            }

            .tasks-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .task-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .complete-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="logo">
        Member<span>ship</span>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit" class="logout-button">
            Logout
        </button>
    </form>
</header>

<main class="container">

    @if (session('success'))
        <div class="success-message" id="success-message">
            {{ session('success') }}
        </div>
    @endif

    <section class="hero">
        <div class="hero-content">
            <h1>
                Welcome, {{ $member->name }}!
            </h1>

            <p>
                Membership Number:
                <span class="membership-number">
                    {{ $member->membership_number }}
                </span>
            </p>

            <p>
                Stay on track and complete your assigned tasks.
            </p>
        </div>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">
                Total Tasks
            </div>

            <div class="stat-number">
                {{ $totalTasks }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                Pending Tasks
            </div>

            <div class="stat-number">
                {{ $pendingTasks }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                Completed Tasks
            </div>

            <div class="stat-number">
                {{ $completedTasks }}
            </div>
        </div>
    </section>

    <section class="tasks-card">

        <div class="tasks-header">
            <h2>
                My Assigned Tasks
            </h2>

            <span class="task-count">
                {{ $totalTasks }}
                {{ $totalTasks === 1 ? 'Task' : 'Tasks' }}
            </span>
        </div>

        <div class="progress-wrapper">
            <div class="progress-info">
                <span>Task progress</span>
                <strong>{{ $progress }}%</strong>
            </div>

            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>

        @forelse ($tasks as $task)

            <div class="task-item">

                <div class="task-details">
                    <h3 class="task-title">
                        {{ $task->task_title }}
                    </h3>

                    <p class="task-description">
                        {{ $task->description ?: 'No description provided.' }}
                    </p>

                    @if ($task->completed)
                        <span class="task-status status-completed">
                            Completed
                        </span>
                    @else
                        <span class="task-status status-pending">
                            Pending
                        </span>
                    @endif
                </div>

                @if (!$task->completed)
                    <form
                        action="{{ route('member.tasks.complete', $task) }}"
                        method="POST"
                        onsubmit="
                            return confirm(
                                'Mark this task as completed?'
                            );
                        "
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="complete-button"
                        >
                            Mark as Completed
                        </button>
                    </form>
                @endif

            </div>

        @empty

            <div class="empty-state">
                No tasks have been assigned to you yet.
            </div>

        @endforelse

    </section>

</main>

<script>
    const successMessage =
        document.getElementById('success-message');

    if (successMessage) {
        setTimeout(() => {
            successMessage.classList.add('hide');

            setTimeout(() => {
                successMessage.remove();
            }, 500);
        }, 3000);
    }
</script>

</body>
</html>