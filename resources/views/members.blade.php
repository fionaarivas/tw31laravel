<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Members | Membership System</title>

    <style>
        :root {
            --background: #464646;
            --panel: #49484a;
            --panel-light: #29222f;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --pink-dark: #c967a8;
            --purple: #a984df;
            --green: #72d69b;
            --orange: #e5a45d;
            --blue: #78c9dd;
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
                    #313131 0%,
                    #584b54 52%,
                    #18131d 100%
                );
            color: var(--text);
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
        }

        h1,
        h2,
        h3,
        button,
        input,
        select,
        textarea {
            font-family: inherit;
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
            margin-bottom: 27px;
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

        .page-header p {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .add-button,
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .add-button {
            min-height: 45px;
            padding: 0 19px;
            background:
                linear-gradient(
                    135deg,
                    #e984c5,
                    #bd71b5
                );
            color: #ffffff;
            white-space: nowrap;
            box-shadow: 0 9px 20px rgba(233, 132, 197, .2);
        }

        .add-button:hover {
            background: var(--pink-dark);
            transform: translateY(-2px);
        }

        .success-message {
            margin-bottom: 20px;
            padding: 13px 17px;
            border: 1px solid rgba(114, 214, 155, .3);
            border-radius: 11px;
            background: rgba(114, 214, 155, .1);
            color: var(--green);
            transition: opacity .5s ease, transform .5s ease;
        }

        .success-message.hide {
            opacity: 0;
            transform: translateY(-8px);
        }

        .search-box {
          display: flex;
          align-items: center;
          width: fit-content;
          max-width: 100%;
          gap: 10px;
          margin-bottom: 20px;
          padding: 12px 14px;
          border: 1px solid var(--border);
          border-radius: 16px;
          background: rgba(28, 24, 33, .92);
          box-shadow: 0 8px 20px rgba(0, 0, 0, .10);
      }

        .search-box input {
             width: 360px;
             min-height: 42px;
             padding: 0 14px;
            }

        .search-box input:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(233, 132, 197, .13);
        }

        .search-box input::placeholder {
            color: #8e8795;
        }

        .button {
            min-height: 42px;
            padding: 0 16px;
        }

        .primary {
            background: var(--pink);
            color: #ffffff;
        }

        .primary:hover {
            background: var(--pink-dark);
            transform: translateY(-1px);
        }

        .secondary {
            background: #302a36;
            color: #d7ceda;
        }

        .secondary:hover {
            background: #3b3342;
        }

        .card {
            overflow-x: hidden;
            padding: 25px 27px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(24, 21, 28, .95);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .22);
        }

        table {
            width: 100%;
            min-width: 0;
            table-layout: auto;
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
            color: var(--pink);
            font-weight: 750;
        }

        td:nth-child(2) {
            color: var(--text);
            font-weight: 700;
        }

        td:nth-child(3) {
             max-width: 210px;
             overflow-wrap: anywhere;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .active {
            background: rgba(114, 214, 155, .13);
            color: var(--green);
        }

        .inactive {
            background: rgba(240, 141, 168, .13);
            color: #f08da8;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            min-width: 300px;
        }

        .actions form {
            display: inline;
        }

        .actions .button {
            min-height: 34px;
            padding: 0 11px;
            font-size: 11px;
        }

        .view {
            background: rgba(120, 201, 221, .13);
            color: var(--blue);
        }

        .view:hover {
            background: rgba(120, 201, 221, .23);
        }

        .edit {
            background: rgba(229, 164, 93, .13);
            color: var(--orange);
        }

        .edit:hover {
            background: rgba(229, 164, 93, .23);
        }

        .deactivate {
            background: rgba(240, 141, 168, .13);
            color: #f08da8;
        }

        .deactivate:hover {
            background: rgba(240, 141, 168, .23);
        }

        .activate {
            background: rgba(114, 214, 155, .13);
            color: var(--green);
        }

        .activate:hover {
            background: rgba(114, 214, 155, .23);
        }

        .delete {
            background: rgba(213, 100, 143, .16);
            color: #f18aaa;
        }

        .delete:hover {
            background: rgba(213, 100, 143, .28);
        }

        .empty {
            padding: 40px 25px;
            border: 1px dashed rgba(255, 255, 255, .18);
            border-radius: 13px;
            background: rgba(255, 255, 255, .025);
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 950px) {
            .main {
                padding: 30px 27px 50px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 700px) {
            .layout {
                display: block;
            }

            .main {
                padding: 25px 17px 40px;
            }

            .page-header h1 {
                font-size: 31px;
            }

            .add-button {
                width: 100%;
            }

            .search-box {
                align-items: stretch;
                flex-direction: column;
            }

            .search-box input,
            .search-box .button {
                width: 100%;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">

        <div class="page-header">
            <div>

                <h1>Members</h1>

                <p>
                    Manage registered members and membership information.
                </p>
            </div>

            <a
                href="{{ route('members.create') }}"
                class="add-button"
            >
                + Add New Member
            </a>
        </div>

        @if (session('success'))
            <div
                id="success-message"
                class="success-message"
            >
                {{ session('success') }}
            </div>
        @endif

        <form
            action="{{ route('members.index') }}"
            method="GET"
            class="search-box"
        >
            <input
                type="text"
                name="search"
                placeholder="Search by name, category, or level"
                value="{{ $search ?? '' }}"
            >

            <button
                type="submit"
                class="button primary"
            >
                Search
            </button>

            <a
                href="{{ route('members.index') }}"
                class="button secondary"
            >
                Clear
            </a>
        </form>

        <div class="card">

            @forelse ($members as $member)

                @if ($loop->first)
                    <table>
                        <thead>
                            <tr>
                                <th>Membership No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Category</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                @endif

                            <tr>
                                <td>
                                    {{ $member->membership_number }}
                                </td>

                                <td>
                                    {{ $member->name }}
                                </td>

                                <td>
                                    {{ $member->email }}
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
                                        {{ ucfirst($member->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('members.show', $member) }}"
                                            class="button view"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('members.edit', $member) }}"
                                            class="button edit"
                                        >
                                            Edit
                                        </a>

                                        @if ($member->status === 'active')

                                            <form
                                                action="{{ route('members.deactivate', $member) }}"
                                                method="POST"
                                                onsubmit="return confirm('Deactivate this member?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="button deactivate"
                                                >
                                                    Deactivate
                                                </button>
                                            </form>

                                        @else

                                            <form
                                                action="{{ route('members.activate', $member) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="button activate"
                                                >
                                                    Activate
                                                </button>
                                            </form>

                                        @endif

                                        <form
                                            action="{{ route('members.destroy', $member) }}"
                                            method="POST"
                                            onsubmit="return confirm('Permanently delete this member?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="button delete"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                @if ($loop->last)
                        </tbody>
                    </table>
                @endif

            @empty

                <div class="empty">
                    No members found.
                </div>

            @endforelse

        </div>

    </main>

</div>

<script>
    setTimeout(function () {
        const message =
            document.getElementById('success-message');

        if (message) {
            message.classList.add('hide');

            setTimeout(function () {
                message.remove();
            }, 500);
        }
    }, 3000);
</script>

</body>
</html>