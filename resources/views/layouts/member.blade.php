<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Member') · {{ config('app.name', 'Membership') }}</title>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            /* Surfaces: muted plum, lighter as they come forward */
            --bg: #3d2f4c;
            --bg-deep: #34283f;
            --nav: rgba(78, 62, 96, .94);
            --surface: #57476a;
            --surface-top: #5f4e73;
            --surface-2: #685782;

            /* Text */
            --text: #fbf6ef;
            --muted: #d3c7dc;

            /* Accents (soft, used sparingly) */
            --pink: #f2a7cb;
            --purple: #c7a9ec;

            --border: rgba(255, 255, 255, .13);
            --border-strong: rgba(255, 255, 255, .2);
            --shadow: 0 10px 28px rgba(28, 16, 38, .22), 0 2px 6px rgba(28, 16, 38, .12);

            /* Status colours */
            --green: #9be3b8;
            --green-bg: rgba(155, 227, 184, .18);
            --amber: #f6c983;
            --amber-bg: rgba(246, 201, 131, .18);
            --violet: #cdb6ff;
            --violet-bg: rgba(205, 182, 255, .2);
            --red: #ffabb5;
            --red-bg: rgba(255, 171, 181, .18);
            --grey-bg: rgba(255, 255, 255, .1);

            --radius: 16px;
        }

        html,
        body {
            margin: 0;
            min-height: 100vh;
        }

        body {
            background:
                radial-gradient(ellipse at 10% -10%, rgba(199, 169, 236, .22), transparent 55%),
                radial-gradient(ellipse at 100% 0%, rgba(242, 167, 203, .14), transparent 45%),
                linear-gradient(180deg, var(--bg) 0%, var(--bg-deep) 100%);
            background-attachment: fixed;
            color: var(--text);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
        }

        a {
            color: inherit;
        }

        /* ---------- Top navigation ---------- */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: var(--nav);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 18px rgba(28, 16, 38, .18);
            backdrop-filter: blur(12px);
        }

        .topbar-inner {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 24px;
            height: 66px;
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            letter-spacing: .2px;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand-mark {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--pink), var(--purple));
            box-shadow: 0 3px 10px rgba(242, 167, 203, .3);
            display: grid;
            place-items: center;
            font-size: 14px;
            color: #4a3459;
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
            height: 38px;
            padding: 0 14px;
            border-radius: 10px;
            border: 0;
            background: transparent;
            color: var(--muted);
            font: inherit;
            font-weight: 500;
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
            background: rgba(255, 255, 255, .14);
            color: var(--text);
            box-shadow: inset 0 -2px 0 var(--pink);
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
            max-width: 1080px;
            margin: 0 auto;
            padding: 40px 24px 72px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0 0 6px;
            color: var(--text);
            font-size: 27px;
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .page-header p {
            margin: 0;
            color: var(--muted);
        }

        .section {
            margin-top: 34px;
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
            color: var(--text);
            font-size: 17px;
            font-weight: 600;
        }

        .section-head a {
            color: var(--pink);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .section-head a:hover {
            text-decoration: underline;
        }

        .card {
            background: linear-gradient(180deg, var(--surface-top) 0%, var(--surface) 100%);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px 26px;
        }

        /* Definition grid for read-only details */
        .details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 22px 30px;
            margin: 0;
        }

        .details div {
            min-width: 0;
        }

        .details dt {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .details dd {
            margin: 0;
            color: var(--text);
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        /* ---------- Badges ---------- */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 11px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
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
            min-width: 170px;
            height: 42px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 11px;
            font: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: filter .15s, transform .05s, box-shadow .15s;
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--pink), var(--purple));
            color: #43304f;
            box-shadow: 0 4px 14px rgba(242, 167, 203, .25);
        }

        .btn-primary:hover {
            filter: brightness(1.05);
        }

        .btn-success {
            background: var(--green);
            color: #234433;
            box-shadow: 0 4px 14px rgba(155, 227, 184, .22);
        }

        .btn-success:hover {
            filter: brightness(1.05);
        }

        .btn[disabled] {
            background: var(--grey-bg);
            border-color: var(--border);
            color: var(--muted);
            box-shadow: none;
            cursor: not-allowed;
            filter: none;
            transform: none;
        }

        /* ---------- Alerts ---------- */
        .alert {
            margin-bottom: 22px;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid;
            font-size: 14px;
        }

        .alert-success {
            background: var(--green-bg);
            border-color: rgba(155, 227, 184, .4);
            color: var(--green);
        }

        .alert-error {
            background: var(--red-bg);
            border-color: rgba(255, 171, 181, .4);
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
        @media (max-width: 720px) {
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
                font-size: 18px;
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

            .nav a.active {
                box-shadow: inset 3px 0 0 var(--pink);
            }

            .nav .logout {
                margin: 6px 0 0;
            }

            .page {
                padding: 26px 16px 52px;
            }

            .page-header h1 {
                font-size: 23px;
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
                <span class="brand-mark">M</span>
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
            >☰</button>

            <nav id="member-nav" class="nav" aria-label="Member navigation">
                <a
                    href="{{ route('member.dashboard') }}"
                    @class(['active' => request()->routeIs('member.dashboard')])
                >Dashboard</a>

                <a
                    href="{{ route('member.tasks.index') }}"
                    @class(['active' => request()->routeIs('member.tasks.*')])
                >Tasks</a>

                <a
    href="{{ route('member.transactions') }}"
    @class([
        'active' => request()->routeIs('member.transactions')
    ])
>
    My Membership
</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="page">
        @if (session('success'))
            <div class="alert alert-success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>
