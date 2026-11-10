<style>
    .shared-sidebar {
        width: 245px;
        min-height: 100vh;
        padding: 25px 18px;
        background: #193b35;
        color: white;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
    }

    .shared-sidebar .brand {
        color: white;
        font-size: 21px;
        font-weight: bold;
        padding: 10px 12px 28px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .shared-sidebar .brand span {
        color: #f6a8c7;
    }

    .shared-sidebar .menu-title {
        margin: 30px 12px 10px;
        color: #b9d4c9;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .shared-sidebar .menu a {
        display: block;
        color: #d8e8df;
        text-decoration: none;
        padding: 13px 14px;
        margin: 6px 0;
        border-radius: 8px;
        font-size: 14px;
    }

    .shared-sidebar .menu a:hover,
    .shared-sidebar .menu a.active {
        background: #e875a8;
        color: white;
        font-weight: bold;
    }

    .shared-sidebar .logout-form {
        margin-top: 35px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .shared-sidebar .logout-button {
        width: 100%;
        border: none;
        border-radius: 8px;
        padding: 13px 14px;
        background: transparent;
        color: white;
        text-align: left;
        font-family: inherit;
        font-size: 14px;
        cursor: pointer;
    }

    .shared-sidebar .logout-button:hover {
        background: #b83e64;
    }

    @media (max-width: 850px) {
        .shared-sidebar {
            width: 205px;
        }
    }
</style>

<aside class="shared-sidebar">

    <div class="brand">
        Member<span>ship</span>
    </div>

    <div class="menu-title">
        Main Menu
    </div>

    <nav class="menu">

        <a
            href="{{ route('dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
        >
            Dashboard
        </a>

        <a
            href="{{ route('members.index') }}"
            class="{{ request()->routeIs('members.*') ? 'active' : '' }}"
        >
            Members
        </a>

        @if (auth()->user()->role === 'admin')
            <a
                href="{{ route('membership-categories.index') }}"
                class="{{ request()->routeIs('membership-categories.*') ? 'active' : '' }}"
            >
                Membership Categories
            </a>
        @endif

    </nav>

    <div class="menu-title">
        Management
    </div>

    <nav class="menu">

        @if (auth()->user()->role === 'admin')
            <a
                href="{{ route('membership-levels.index') }}"
                class="{{ request()->routeIs('membership-levels.*') ? 'active' : '' }}"
            >
                Membership Levels
            </a>
        @endif

        <a
            href="{{ route('transactions.index') }}"
            class="{{ request()->routeIs('transactions.*') ? 'active' : '' }}"
        >
            Transactions
        </a>

        <a
            href="{{ route('payments.index') }}"
            class="{{ request()->routeIs('payments.*') ? 'active' : '' }}"
        >
            Payments
        </a>

    </nav>

    <form
        action="{{ route('logout') }}"
        method="POST"
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