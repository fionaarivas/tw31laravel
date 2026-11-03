<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Membership Categories</title>

    <style>
        :root {
            --background: #f8faf9;
            --sidebar: #193b35;
            --white: #ffffff;
            --pink: #e875a8;
            --pink-hover: #d95f94;
            --green-dark: #337a4b;
            --text: #26332f;
            --muted: #71807a;
            --border: #e4ebe7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
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
        textarea,
        a {
            font-family: inherit;
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
            font-weight: 700;
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
            transition: 0.2s ease;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--pink);
            color: white;
            font-weight: 700;
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
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .topbar p {
            margin-top: 10px;
            color: var(--muted);
            font-size: 15px;
        }

        .add-button {
            background: var(--pink);
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .add-button:hover {
            background: var(--pink-hover);
        }

        .content-card {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(34, 70, 55, 0.06);
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
        }

        .search-input {
            flex: 1;
            border: 1px solid #d7e3dd;
            border-radius: 9px;
            padding: 12px;
            background: #fbfdfc;
            color: var(--text);
            font-size: 14px;
        }

        .search-input:focus {
            outline: none;
            border-color: #86c98b;
            box-shadow: 0 0 0 3px rgba(134, 201, 139, 0.2);
        }

        .button {
            border: none;
            border-radius: 9px;
            padding: 11px 16px;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .search-button {
            background: var(--green-dark);
            color: white;
        }

        .search-button:hover {
            background: #28633b;
        }

        .clear-button {
            background: #eef3f0;
            color: #52635b;
        }

        .clear-button:hover {
            background: #dfe9e4;
        }

        .success-message,
        .error-message {
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: #e4f5e7;
            color: var(--green-dark);
        }

        .error-message {
            background: #fff0f4;
            color: #b83e64;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            color: var(--muted);
            text-align: left;
            padding: 13px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 15px 13px;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover {
            background: #fff7fa;
        }

        .category-name {
            color: var(--green-dark);
            font-weight: 600;
        }

        .description {
            color: var(--muted);
            max-width: 280px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status.active {
            background: #e2f4e4;
            color: var(--green-dark);
        }

        .status.inactive {
            background: #fff0f4;
            color: #b83e64;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-button {
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            transition: 0.2s ease;
        }

        .view-button {
            background: #dceef3;
            color: #216075;
        }

        .view-button:hover {
            background: #c8e4eb;
        }

        .edit-button {
            background: #fff0d8;
            color: #a8631b;
        }

        .edit-button:hover {
            background: #ffe5bc;
        }

        .deactivate-button {
            background: #fde4ee;
            color: #b83e64;
        }

        .deactivate-button:hover {
            background: #f8cede;
        }

        .activate-button {
            background: #e2f4e4;
            color: var(--green-dark);
        }

        .activate-button:hover {
            background: #d0ead4;
        }

        .delete-button {
            background: #f8d8e1;
            color: #a83258;
        }

        .delete-button:hover {
            background: #f1c3d0;
        }

        .empty-message {
            text-align: center;
            color: var(--muted);
            padding: 35px;
        }

        @media (max-width: 900px) {
            .main {
                padding: 30px 25px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
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

            .search-form {
                flex-direction: column;
            }

            .search-button,
            .clear-button {
                width: 100%;
                text-align: center;
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

            <div class="menu-title">
                Main Menu
            </div>

            <nav class="menu">

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a href="{{ route('members.index') }}">
                    Members
                </a>

                <a
                    href="{{ route('membership-categories.index') }}"
                    class="active"
                >
                    Membership Categories
                </a>

            </nav>

            <div class="menu-title">
                Management
            </div>

            <nav class="menu">

            <a
                    href="{{ route('membership-levels.index') }}"
                >
                    Membership Levels
                </a>

               <a href="{{ route('transactions.index') }}">
                    Transactions
                </a>

               <a
                    href="{{ route('payments.index') }}"

                >
                    Payments
                </a>

            </nav>

        </aside>

        <main class="main">

            <div class="topbar">

                <div>
                    <h1>Membership Categories</h1>

                    <p>
                        Manage the categories available for members.
                    </p>
                </div>

                <a
                    href="{{ route('membership-categories.create') }}"
                    class="add-button"
                >
                    + Add Category
                </a>

            </div>

            <section class="content-card">

                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="error-message">
                        {{ session('error') }}
                    </div>
                @endif

                <form
                    action="{{ route('membership-categories.index') }}"
                    method="GET"
                    class="search-form"
                >
                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        value="{{ $search ?? '' }}"
                        placeholder="Search category..."
                    >

                    <button
                        type="submit"
                        class="button search-button"
                    >
                        Search
                    </button>

                    <a
                        href="{{ route('membership-categories.index') }}"
                        class="button clear-button"
                    >
                        Clear
                    </a>
                </form>

                <div class="table-wrapper">

                    <table>
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($categories as $category)

                                <tr>
                                    <td class="category-name">
                                        {{ $category->name }}
                                    </td>

                                    <td class="description">
                                        {{ $category->description ?? 'No description' }}
                                    </td>

                                    <td>
                                        @if ($category->is_active)
                                            <span class="status active">
                                                Active
                                            </span>
                                        @else
                                            <span class="status inactive">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="actions">

                                            <a
                                                href="{{ route('membership-categories.show', $category) }}"
                                                class="action-button view-button"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('membership-categories.edit', $category) }}"
                                                class="action-button edit-button"
                                            >
                                                Edit
                                            </a>

                                            @if ($category->is_active)

                                                <form
                                                    action="{{ route('membership-categories.deactivate', $category) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Deactivate this category?')"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="action-button deactivate-button"
                                                    >
                                                        Deactivate
                                                    </button>
                                                </form>

                                            @else

                                                <form
                                                    action="{{ route('membership-categories.activate', $category) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="action-button activate-button"
                                                    >
                                                        Activate
                                                    </button>
                                                </form>

                                            @endif

                                            <form
                                                action="{{ route('membership-categories.destroy', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('Permanently delete this category?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-button delete-button"
                                                >
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="4"
                                        class="empty-message"
                                    >
                                        No membership categories found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

            </section>

        </main>

    </div>

</body>
</html>