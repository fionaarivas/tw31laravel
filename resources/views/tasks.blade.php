<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task List - Life Flows Forward</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            background:
                linear-gradient(
                    rgba(12, 24, 23, 0.35),
                    rgba(10, 22, 18, 0.72)
                ),
                url('https://i.pinimg.com/1200x/12/74/79/1274791065449a134942fce93aa6986a.jpg')
                center center / cover fixed no-repeat;
        }

        .container {
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
            padding: 35px 22px 55px;
        }

        .back-button-wrapper {
            position: fixed;
            top: 35px;
            left: 35px;
            z-index: 10;
        }

        .back-button {
            display: inline-block;
            padding: 12px 24px;
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 10px;
            background: rgba(70, 65, 70, 0.55);
            color: #ffffff;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: 0.25s;
        }

        .back-button:hover {
            background: rgba(232, 184, 210, 0.85);
            color: #26382d;
        }

        header {
            margin-bottom: 22px;
            padding: 30px 10px 25px;
            text-align: center;
        }

        .chapter {
            display: block;
            margin-bottom: -8px;
            color: #e9c6dc;
            font-family: 'Cormorant Garamond', serif;
            font-size: 19px;
        }

        h1 {
            margin: 0;
            color: #f4c4df;
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(42px, 8vw, 68px);
            font-style: italic;
            font-weight: 500;
            line-height: 1.15;
            text-shadow: 0 2px 12px rgba(0, 0, 0, 0.35);
        }

        header p {
            margin: 8px 0 0;
            color: #ffffff;
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
        }

        .quote-translation {
            margin-top: 4px;
            color: #e0e5db;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .form-card {
            max-width: 660px;
            margin: 0 auto 35px;
            padding: 28px;
            background: rgba(39, 41, 40, 0.70);
            border: 1px solid rgba(231, 216, 225, 0.3);
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.18);
            backdrop-filter: blur(12px);
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #ead6e2;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        textarea,
        select {
            display: block;
            width: 100%;
            margin-bottom: 17px;
            padding: 13px 15px;
            border: 1px solid rgba(231, 216, 225, 0.35);
            border-radius: 7px;
            background: rgba(255, 255, 255, 0.09);
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #c7c9c1;
        }

        select option {
            background: #ffffff;
            color: #26382d;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #e8b8d2;
            box-shadow: 0 0 0 2px rgba(232, 184, 210, 0.12);
        }

        textarea {
            min-height: 85px;
            resize: vertical;
        }

        button {
            padding: 11px 22px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            background: #dcb1c8;
            color: #26382d;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s;
        }

        button:hover {
            background: #f0d1e1;
            transform: translateY(-1px);
        }

        .success {
            max-width: 660px;
            margin: 0 auto 18px;
            padding: 11px 15px;
            border: 1px solid rgba(183, 226, 190, 0.5);
            border-radius: 7px;
            background: rgba(37, 83, 54, 0.8);
            color: #e0f7df;
            font-size: 13px;
        }

        .error {
            margin-top: -12px;
            margin-bottom: 14px;
            color: #ffb8c2;
            font-size: 12px;
        }

        h2 {
            max-width: 660px;
            margin: 0 auto 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(244, 196, 223, 0.4);
            color: #f4c4df;
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 500;
        }

        article {
            max-width: 660px;
            margin: 0 auto 14px;
            padding: 22px 24px;
            display: grid;
            grid-template-columns: 1fr auto;
            column-gap: 25px;
            align-items: center;
            overflow-wrap: anywhere;
            background: rgba(29, 16, 22, 0.75);
            border: 1px solid rgba(231, 216, 225, 0.25);
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(8px);
            transition: 0.25s;
        }

        article:hover {
            background: rgba(25, 42, 34, 0.88);
            border-color: rgba(244, 196, 223, 0.55);
        }

        article h3,
        article p,
        article .task-status {
            grid-column: 1;
        }

        article h3 {
            margin: 0 0 8px;
            color: #f4c4df;
            font-family: 'Cormorant Garamond', serif;
            font-size: 25px;
            font-weight: 600;
        }

        article p {
            margin: 5px 0;
            color: #e3e7df;
            font-size: 13px;
        }

        .assigned-member {
            color: #f0c8dc;
            font-weight: 600;
        }

        .task-status {
            width: fit-content;
            display: inline-block;
            margin-top: 12px;
            padding: 5px 11px;
            border-radius: 20px;
            background: rgba(103, 142, 100, 0.25);
            color: #e0f0d9;
            font-size: 11px;
        }

        .delete-form {
            grid-column: 2;
            grid-row: 1 / span 5;
            margin: 0;
            align-self: center;
        }

        .delete-button {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            background: #f3cbd8;
            color: #9d2852;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .delete-button:hover {
            background: #e9a9c0;
            color: #ffffff;
            transform: translateY(-1px);
        }

        hr {
            max-width: 660px;
            margin: 17px auto;
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .empty-state {
            max-width: 660px;
            margin: 0 auto;
            padding: 26px 20px;
            border: 1px dashed rgba(244, 196, 223, 0.45);
            border-radius: 9px;
            background: rgba(16, 29, 25, 0.65);
            color: #f4c4df;
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            text-align: center;
        }

        .empty-state p {
            margin: 0;
        }

        .closing-note {
            margin-top: 30px;
            color: #e5dce1;
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-style: italic;
            text-align: center;
        }

        @media (max-width: 600px) {
            .container {
                padding: 22px 15px 35px;
            }

            .back-button-wrapper {
                top: 20px;
                left: 20px;
            }

            .back-button {
                padding: 9px 15px;
                font-size: 12px;
            }

            header {
                padding: 70px 5px 20px;
            }

            h1 {
                font-size: 43px;
            }

            header p {
                font-size: 16px;
            }

            .form-card {
                padding: 19px;
            }

            h2 {
                font-size: 28px;
            }

            article {
                display: block;
                padding: 17px;
            }

            .delete-form {
                margin-top: 18px;
            }

            .delete-button {
                width: 100%;
            }
        }

        /* ADMIN DASHBOARD THEME */

body {
    background:
        radial-gradient(
            circle at top right,
            rgba(232, 117, 184, 0.12),
            transparent 34%
        ),
        #242027;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
}

.container {
    max-width: 1120px;
    padding: 38px 28px 65px;
}

.back-button-wrapper {
    position: static;
    margin-bottom: 25px;
}

.back-button {
    display: inline-flex;
    align-items: center;
    padding: 11px 18px;
    border: 1px solid rgba(232, 117, 184, 0.5);
    border-radius: 8px;
    background: #302834;
    color: #f08bc2;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    backdrop-filter: none;
}

.back-button:hover {
    background: #e875b8;
    color: #241d27;
}

header {
    margin-bottom: 32px;
    padding: 12px 0 8px;
    text-align: left;
}

.chapter {
    display: block;
    margin-bottom: 8px;
    color: #e875b8;
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
}

h1 {
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    font-size: clamp(34px, 5vw, 52px);
    font-style: normal;
    font-weight: 700;
    letter-spacing: -1px;
    text-shadow: none;
}

header p {
    margin-top: 10px;
    color: #c8becb;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    text-shadow: none;
}

.quote-translation {
    display: none;
}

.form-card {
    max-width: none;
    margin: 0 0 38px;
    padding: 27px;
    background: #17141b;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-left: 3px solid #e875b8;
    border-radius: 15px;
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.22);
    backdrop-filter: none;
}

label {
    color: #e9e1eb;
    font-size: 13px;
    font-weight: 600;
}

input[type="text"],
textarea,
select {
    margin-bottom: 18px;
    padding: 13px 15px;
    border: 1px solid #4a414d;
    border-radius: 8px;
    background: #25202a;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
}

input::placeholder,
textarea::placeholder {
    color: #958b9a;
}

select option {
    background: #25202a;
    color: #ffffff;
}

input:focus,
textarea:focus,
select:focus {
    border-color: #e875b8;
    box-shadow: 0 0 0 3px rgba(232, 117, 184, 0.12);
}

button {
    padding: 12px 22px;
    border: none;
    border-radius: 8px;
    background: #e875b8;
    color: #241d27;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    font-weight: 700;
}

button:hover {
    background: #f394c9;
    transform: translateY(-1px);
}

.success {
    max-width: none;
    margin: 0 0 22px;
    padding: 12px 16px;
    border: 1px solid rgba(99, 217, 155, 0.35);
    border-radius: 8px;
    background: rgba(45, 117, 82, 0.22);
    color: #72dfa5;
}

.error {
    color: #f28ba9;
}

h2 {
    max-width: none;
    margin: 0 0 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    font-size: 25px;
    font-weight: 700;
}

article {
    max-width: none;
    margin: 0 0 15px;
    padding: 23px 25px;
    background: #17141b;
    border: 1px solid rgba(255, 255, 255, 0.11);
    border-radius: 14px;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
    backdrop-filter: none;
}

article:hover {
    background: #211c25;
    border-color: rgba(232, 117, 184, 0.45);
}

article h3 {
    color: #f08bc2;
    font-family: 'Poppins', sans-serif;
    font-size: 20px;
    font-weight: 700;
}

article p {
    color: #c9bfcc;
    font-size: 13px;
}

.assigned-member {
    color: #ffffff;
    font-weight: 600;
}

.task-status {
    margin-top: 12px;
    padding: 6px 12px;
    border-radius: 20px;
    background: rgba(99, 217, 155, 0.14);
    color: #72dfa5;
    font-size: 11px;
    font-weight: 700;
}

.delete-button {
    padding: 10px 15px;
    border-radius: 7px;
    background: rgba(240, 141, 168, 0.15);
    color: #f28ba9;
    font-size: 12px;
}

.delete-button:hover {
    background: #f28ba9;
    color: #241d27;
}

hr {
    max-width: none;
    margin: 15px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
}

.empty-state {
    max-width: none;
    padding: 35px 20px;
    border: 1px dashed rgba(232, 117, 184, 0.4);
    border-radius: 12px;
    background: #17141b;
    color: #c8becb;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
}

.closing-note {
    margin-top: 35px;
    color: #e875b8;
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
    font-style: normal;
    font-weight: 600;
    letter-spacing: 1px;
}
    </style>
</head>

<body>

<div class="container">

    <div class="back-button-wrapper">
        <a
            href="{{ route('task.dashboard') }}"
            class="back-button"
        >
            ← Back to Task Dashboard
        </a>
    </div>

    <header>
        <span class="chapter">🦢</span>

        <h1>Chapter of Tasks</h1>

        <p>
            Take each day gently, and let every little progress bloom
        </p>

        <div class="quote-translation">
            One lovely step at a time.
        </div>
    </header>

    @if (session('success'))
        <div class="success" id="success-message">
            🌷 {{ session('success') }}
        </div>
    @endif

    <form
        class="form-card"
        action="{{ route('tasks.store') }}"
        method="POST"
    >
        @csrf

        <label for="task_title">
            Task title:
        </label>

        <input
            type="text"
            id="task_title"
            name="task_title"
            value="{{ old('task_title') }}"
            placeholder="Enter task title"
            required
        >

        @error('task_title')
            <p class="error">
                {{ $message }}
            </p>
        @enderror

        <label for="description">
            Description:
        </label>

        <textarea
            id="description"
            name="description"
            placeholder="Enter task description"
        >{{ old('description') }}</textarea>

        @error('description')
            <p class="error">
                {{ $message }}
            </p>
        @enderror

        <label for="member_id">
            Assign to member:
        </label>

        <select
            id="member_id"
            name="member_id"
            required
        >
            <option value="">
                Choose a member
            </option>

            @foreach ($members as $member)
                <option
                    value="{{ $member->id }}"
                    {{ old('member_id') == $member->id ? 'selected' : '' }}
                >
                    {{ $member->name }}
                    —
                    {{ $member->membership_number }}
                </option>
            @endforeach
        </select>

        @error('member_id')
            <p class="error">
                {{ $message }}
            </p>
        @enderror

        <button type="submit">
            + Add Task
        </button>
    </form>

    <h2>
        Saved Tasks
    </h2>

    @forelse ($tasks as $task)

        <article>
            <h3>
                {{ $task->task_title }}
            </h3>

            <p>
                {{
                    $task->description
                    ?: 'No description provided.'
                }}
            </p>

            <p>
                Assigned to:
                <span class="assigned-member">
                    {{ $task->member?->name ?? 'Unassigned' }}
                </span>
            </p>

            <p>
                Membership Number:
                <span class="assigned-member">
                    {{
                        $task->member?->membership_number
                        ?? '—'
                    }}
                </span>
            </p>

            <span class="task-status">
                Status:
                {{ $task->statusLabel() }}
            </span>

            <form
                class="delete-form"
                action="{{ route('tasks.destroy', $task) }}"
                method="POST"
                onsubmit="
                    return confirm(
                        'Are you sure you want to remove this task?'
                    );
                "
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="delete-button"
                >
                    Delete Task
                </button>
            </form>
        </article>

        <hr>

    @empty

        <div class="empty-state">
            <p>
                ❀ No tasks have been added yet. ❀
            </p>
        </div>

    @endforelse

    <div class="closing-note">
        ✦ YOUR TASKS, YOUR JOURNEY ✦
    </div>

</div>

<script>
    const successMessage =
        document.getElementById('success-message');

    if (successMessage) {
        setTimeout(() => {
            successMessage.remove();
        }, 3500);
    }
</script>

</body>
</html>