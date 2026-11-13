<style>
    @import url(
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap'
    );

    .sidebar {
        display: flex;
        flex-direction: column;
        width: 245px;
        min-height: 100vh;
        flex-shrink: 0;
        padding: 23px 15px;
        border-right: 1px solid rgba(255, 255, 255, .12);
        background:
            linear-gradient(
                180deg,
                #17141b 0%,
                #111016 100%
            );
        color: #ffffff;
        font-family:
            "Inter",
            "Segoe UI",
            Arial,
            sans-serif;
    }

    .brand {
        margin: 0 5px;
        padding: 10px 13px 27px;
        border-bottom: 1px solid rgba(255, 255, 255, .11);
        color: #ffffff;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -.7px;
    }

    .brand span {
        color: #e984c5;
    }

    .menu-title {
        margin: 30px 13px 13px;
        color: #dad9da !important;
        font-size: 10px;
        font-weight: 700 !important;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        min-height: 44px;
        margin-bottom: 5px;
        padding: 11px 13px;
        border: 1px solid transparent;
        border-radius: 11px;
        color: #c9c1ce;
        text-decoration: none;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 500;
        letter-spacing: -.1px;
        transition: .2s ease;
    }

    .nav-link::before {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 7px;
        background: rgba(255, 255, 255, .04);
        color: #a99faf;
        font-size: 10px;
        font-weight: 700;
        content: "•";
    }

    .nav-link[href*="dashboard"]::before {
        content: "⌂";
    }

    .nav-link[href*="members"]::before {
        content: "M";
    }

    .nav-link[href*="task"]::before {
        content: "✓";
    }

    .nav-link[href*="categor"]::before {
        content: "C";
    }

    .nav-link[href*="level"]::before {
        content: "L";
    }

    .nav-link[href*="transaction"]::before {
        content: "T";
    }

    .nav-link[href*="payment"]::before {
        content: "₱";
    }

    .nav-link:hover {
        border-color: rgba(233, 132, 197, .23);
        background: rgba(233, 132, 197, .09);
        color: #ffffff;
        transform: translateX(2px);
    }

    .nav-link:hover::before {
        border-color: rgba(233, 132, 197, .35);
        background: rgba(233, 132, 197, .14);
        color: #e984c5;
    }

    .nav-link.active {
        border-color: rgba(233, 132, 197, .35);
        background:
            linear-gradient(
                100deg,
                rgba(233, 132, 197, .36),
                rgba(137, 89, 160, .24)
            );
        color: #ffffff;
        box-shadow:
            inset 3px 0 0 #e984c5,
            0 7px 18px rgba(0, 0, 0, .18);
    }

    .nav-link.active::before {
        border-color: rgba(255, 255, 255, .23);
        background: rgba(255, 255, 255, .13);
        color: #ffffff;
    }

    .logout-form {
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid rgba(255, 255, 255, .11);
    }

    .logout-button {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        min-height: 44px;
        padding: 11px 13px;
        border: 1px solid transparent;
        border-radius: 11px;
        background: transparent;
        color: #c9c1ce;
        text-align: left;
        font-family: "Inter", sans-serif;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: .2s ease;
    }

    .logout-button::before {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 7px;
        color: #a99faf;
        font-size: 13px;
        content: "↪";
    }

    .logout-button:hover {
        border-color: rgba(240, 141, 168, .28);
        background: rgba(240, 141, 168, .12);
        color: #f08da8;
    }

    .logout-button:hover::before {
        border-color: rgba(240, 141, 168, .35);
        color: #f08da8;
    }

    @media (max-width: 700px) {
        .sidebar {
            display: block;
            width: 100%;
            min-height: auto;
            padding: 15px;
            border-right: none;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .brand {
            padding: 8px 10px 18px;
        }

        .menu-title {
            margin: 20px 10px 9px;
        }

        .nav-link {
            display: inline-flex;
            width: auto;
            margin: 0 4px 5px 0;
            padding: 9px 11px;
        }

        .logout-form {
            margin-top: 14px;
            padding-top: 13px;
        }

        .logout-button {
            width: auto;
        }
    }
</style>

<aside class="sidebar">

    <div class="brand">
        Member<span>ship</span>
    </div>

    <div class="menu-title">
        Main Menu
    </div>

    <a
        href="{{ route('dashboard') }}"
        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
    >
        Dashboard
    </a>

    <a
        href="{{ route('members.index') }}"
        class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}"
    >
        Members
    </a>

    <a
        href="{{ route('task.dashboard') }}"
        class="nav-link {{
            request()->routeIs('task.dashboard', 'tasks.*')
                ? 'active'
                : ''
        }}"
    >
        Tasks
    </a>

    @if (auth()->check() && auth()->user()->role === 'admin')

        <div class="menu-title">
            Management
        </div>

        <a
            href="{{ route('membership-categories.index') }}"
            class="nav-link {{
                request()->routeIs('membership-categories.*')
                    ? 'active'
                    : ''
            }}"
        >
            Membership Categories
        </a>

        <a
            href="{{ route('membership-levels.index') }}"
            class="nav-link {{
                request()->routeIs('membership-levels.*')
                    ? 'active'
                    : ''
            }}"
        >
            Membership Levels
        </a>

        <div class="menu-title">
            Financial Activity
        </div>

        <a
            href="{{ route('transactions.index') }}"
            class="nav-link {{
                request()->routeIs('transactions.*')
                    ? 'active'
                    : ''
            }}"
        >
            Transactions
        </a>

        <a
            href="{{ route('payments.index') }}"
            class="nav-link {{
                request()->routeIs('payments.*')
                    ? 'active'
                    : ''
            }}"
        >
            Payments
        </a>

    @endif

    <form
        method="POST"
        action="{{ route('logout') }}"
        class="logout-form"
    >
        @csrf

        <button
            type="submit"
            class="logout-button"
        >
            Logout
        </button>
    </form>

</aside>