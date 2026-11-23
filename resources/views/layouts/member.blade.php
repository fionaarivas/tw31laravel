<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Member') · Membership Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            color-scheme: dark;

            /* Surfaces */
            --bg: #141117;
            --nav: #1a161e;
            --surface: #1e1a23;
            --card: var(--surface);
            --surface-2: #26212b;

            /* Text */
            --text: #f8f4fa;
            --muted: #a99faf;

            /* Accent */
            --pink: #e984c5;
            --pink-hover: #f09ad1;
            --pink-soft: rgba(233, 132, 197, .12);
            --on-pink: #241722;

            --border: rgba(255, 255, 255, .07);
            --border-strong: rgba(255, 255, 255, .12);
            --shadow: 0 1px 2px rgba(0, 0, 0, .25), 0 8px 24px rgba(0, 0, 0, .18);

            /* Status */
            --green: #7fd4a3;
            --green-bg: rgba(127, 212, 163, .12);
            --amber: #e8b46a;
            --amber-bg: rgba(232, 180, 106, .12);
            --violet: #b79cf0;
            --violet-bg: rgba(183, 156, 240, .13);
            --red: #ff8fa8;
            --red-bg: rgba(255, 143, 168, .12);
            --grey-bg: rgba(255, 255, 255, .06);

            --radius: 14px;
        }

        html,
        body {
            margin: 0;
            min-height: 100vh;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
        }

        /* One icon style everywhere: 18px, 1.8 stroke, rounded line icons */
        .icon {
            width: 18px;
            height: 18px;
            flex: none;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ---------- Top navigation ---------- */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: var(--nav);
            border-bottom: 1px solid var(--border);
        }

        .topbar-inner {
            max-width: 1040px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand-mark {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--pink);
            display: grid;
            place-items: center;
            color: var(--on-pink);
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-left: auto;
        }

        .nav a,
        .nav button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 38px;
            padding: 0 14px;
            border-radius: 10px;
            border: 0;
            background: transparent;
            color: var(--muted);
            font: inherit;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .nav a:hover,
        .nav button:hover {
            background: var(--grey-bg);
            color: var(--text);
        }

        .nav a.active {
            background: var(--pink-soft);
            color: var(--pink);
        }

        .nav form {
            margin: 0;
        }

        .nav .logout {
            margin-left: 8px;
            border: 1px solid var(--border-strong);
        }

        .nav-toggle {
            display: none;
        }

        /* ---------- Page ---------- */
        .page {
            max-width: 1040px;
            margin: 0 auto;
            padding: 40px 24px 72px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-header h1 {
            margin: 0 0 4px;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -.2px;
        }

        .page-header p {
            margin: 0;
            color: var(--muted);
        }

        .section {
            margin-top: 32px;
        }

        .section-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .section-head h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .section-head a {
            color: var(--pink);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .section-head a:hover {
            color: var(--pink-hover);
            text-decoration: underline;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
        }

        /* Definition grid for read-only details */
        .details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 22px 28px;
            margin: 0;
        }

        .details div {
            min-width: 0;
        }

        .details dt {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .details dd {
            margin: 0;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        /* ---------- Badges ---------- */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 700;
            white-space: nowrap;
            background: var(--grey-bg);
            color: var(--muted);
        }

        .badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-success {
            background: var(--green-bg);
            color: var(--green);
        }

        .badge-warning {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .badge-info {
            background: var(--violet-bg);
            color: var(--violet);
        }

        .badge-danger {
            background: var(--red-bg);
            color: var(--red);
        }

        /* ---------- Buttons ---------- */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 170px;
            height: 40px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 10px;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .15s, border-color .15s, color .15s;
        }

        .btn-primary {
            background: var(--pink);
            color: var(--on-pink);
        }

        .btn-primary:hover {
            background: var(--pink-hover);
        }

        .btn-secondary {
            background: transparent;
            border-color: var(--pink);
            color: var(--pink);
        }

        .btn-secondary:hover {
            background: var(--pink-soft);
        }

        .btn:focus-visible {
            outline: 2px solid var(--pink);
            outline-offset: 2px;
        }

        .btn[disabled] {
            background: var(--grey-bg);
            border-color: transparent;
            color: var(--muted);
            cursor: not-allowed;
        }

        /* ---------- Alerts ---------- */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: var(--green-bg);
            color: var(--green);
        }

        .alert-error {
            background: var(--red-bg);
            color: var(--red);
        }

        .empty {
            padding: 36px 20px;
            text-align: center;
            color: var(--muted);
        }

        .muted {
            color: var(--muted);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 760px) {
            .topbar-inner {
                height: auto;
                min-height: 60px;
                flex-wrap: wrap;
                padding: 10px 16px;
                gap: 8px;
            }

            .nav-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-left: auto;
                width: 40px;
                height: 40px;
                border: 1px solid var(--border-strong);
                border-radius: 10px;
                background: transparent;
                color: var(--text);
                cursor: pointer;
            }

            .nav {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 2px;
                margin: 4px 0 6px;
            }

            .nav.open {
                display: flex;
            }

            .nav a,
            .nav button {
                width: 100%;
            }

            .nav .logout {
                margin: 6px 0 0;
            }

            .page {
                padding: 24px 16px 52px;
            }

            .page-header h1 {
                font-size: 22px;
            }

            .card {
                padding: 18px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a href="{{ route('member.dashboard') }}" class="brand">
                <span class="brand-mark" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <circle cx="9" cy="12" r="5" stroke="currentColor" stroke-width="2.2" />
                        <circle cx="15" cy="12" r="5" stroke="currentColor" stroke-width="2.2" opacity=".7" />
                    </svg>
                </span>
                <span>Member Portal</span>
            </a>

            <button
                type="button"
                class="nav-toggle"
                aria-label="Toggle navigation"
                aria-controls="member-nav"
                aria-expanded="false"
                onclick="
                    const nav = document.getElementById('member-nav');
                    const open = nav.classList.toggle('open');
                    this.setAttribute('aria-expanded', open);
                "
            >
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" /></svg>
            </button>

            <nav id="member-nav" class="nav" aria-label="Member navigation">
                <a
                    href="{{ route('member.dashboard') }}"
                    @class(['active' => request()->routeIs('member.dashboard')])
                >
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="4" y="4" width="7" height="7" rx="1.5" />
                        <rect x="13" y="4" width="7" height="7" rx="1.5" />
                        <rect x="4" y="13" width="7" height="7" rx="1.5" />
                        <rect x="13" y="13" width="7" height="7" rx="1.5" />
                    </svg>
                    Dashboard
                </a>

                <a
                    href="{{ route('member.tasks.index') }}"
                    @class(['active' => request()->routeIs('member.tasks.*')])
                >
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="4" y="4" width="16" height="16" rx="3" />
                        <path d="M8.5 12.5l2.5 2.5 4.5-5" />
                    </svg>
                    Tasks
                </a>

                <a
                    href="{{ route('member.transactions') }}"
                    @class(['active' => request()->routeIs('member.transactions')])
                >
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2.5" />
                        <circle cx="9" cy="11" r="2" />
                        <path d="M6 16c.6-1.6 1.7-2.4 3-2.4s2.4.8 3 2.4M14.5 10h3.5M14.5 13.5h2.5" />
                    </svg>
                    My Membership
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4M10 16l-4-4 4-4M6 12h10" />
                        </svg>
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="page">
        @if (session('success'))
            <div class="alert alert-success" role="status">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M8.5 12.5l2.5 2.5 4.5-5" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 8v5M12 16h.01" />
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>
