
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task List - Life Flows Forward</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        background:
            linear-gradient(rgba(12, 24, 23, 0.35), rgba(10, 22, 18, 0.72)),
            url('https://i.pinimg.com/1200x/12/74/79/1274791065449a134942fce93aa6986a.jpg')
            center center / cover fixed no-repeat;
    }

    .container {
        width: 100%;
        max-width: 760px;
        margin: 0 auto;
        padding: 35px 22px 55px;
    }

    header {
        text-align: center;
        padding: 30px 10px 25px;
        margin-bottom: 22px;
    }

    .chapter {
        display: block;
        font-family: 'Cormorant Garamond', serif;
        font-size: 19px;
        color: #e9c6dc;
        margin-bottom: -8px;
    }

    h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(42px, 8vw, 68px);
        font-weight: 500;
        font-style: italic;
        line-height: 1.15;
        color: #f4c4df;
        text-shadow: 0 2px 12px rgba(0, 0, 0, 0.35);
        margin: 0;
    }

    header p {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        color: #ffffff;
        margin: 8px 0 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
    }

    .quote-translation {
        font-size: 11px;
        color: #e0e5db;
        margin-top: 4px;
        letter-spacing: 1px;
    }

    .form-card {
        background: rgba(39, 41, 40, 0.63);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(231, 216, 225, 0.3);
        border-radius: 12px;
        padding: 23px;
        max-width: 550px;
        margin: 0 auto 35px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.18);
    }

    label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 0.5px;
        color: #ead6e2;
        margin-bottom: 7px;
    }

    input[type="text"],
    textarea {
        display: block;
        width: 100%;
        padding: 11px 13px;
        margin-bottom: 17px;
        border: 1px solid rgba(231, 216, 225, 0.3);
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.09);
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        transition: border-color 0.2s, background 0.2s;
    }

    input[type="text"]::placeholder,
    textarea::placeholder {
        color: #c7c9c1;
    }

    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        border-color: #e8b8d2;
        background: rgba(255, 255, 255, 0.13);
        box-shadow: 0 0 0 2px rgba(232, 184, 210, 0.12);
    }

    textarea {
        min-height: 85px;
        resize: vertical;
    }

    button {
        padding: 10px 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        background: #dcb1c8;
        color: #26382d;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.25s;
    }

    button:hover {
        background: #f0d1e1;
        transform: translateY(-1px);
    }

    .success {
        max-width: 550px;
        margin: 0 auto 18px;
        padding: 11px 15px;
        border: 1px solid rgba(183, 226, 190, 0.5);
        border-radius: 7px;
        background: rgba(37, 83, 54, 0.8);
        color: #e0f7df;
        font-size: 13px;
    }

    .error {
        color: #ffb8c2;
        font-size: 12px;
        margin-top: -12px;
        margin-bottom: 14px;
    }

    h2 {
        max-width: 550px;
        margin: 0 auto 16px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px;
        font-weight: 500;
        color: #f4c4df;
        border-bottom: 1px solid rgba(244, 196, 223, 0.4);
        padding-bottom: 8px;
    }

    article {
        max-width: 550px;
        margin: 0 auto 14px;
        padding: 19px 21px;
        background: rgba(29, 16, 22, 0.75);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(231, 216, 225, 0.25);
        border-radius: 9px;
        transition: 0.25s;
        overflow-wrap: anywhere;
    }

    article:hover {
        background: rgba(25, 42, 34, 0.88);
        border-color: rgba(244, 196, 223, 0.55);
    }

    article h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 23px;
        font-weight: 600;
        color: #f4c4df;
        margin: 0 0 7px;
    }

    article p {
        color: #e3e7df;
        font-size: 13px;
        margin: 6px 0;
    }

    article p:last-child {
        display: inline-block;
        padding: 4px 10px;
        margin-top: 10px;
        border: 1px solid rgba(211, 231, 202, 0.25);
        border-radius: 20px;
        background: rgba(103, 142, 100, 0.25);
        color: #e0f0d9;
        font-size: 11px;
    }

    hr {
        max-width: 550px;
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        margin: 17px auto;
    }

    .empty-state {
        max-width: 550px;
        margin: 0 auto;
        padding: 26px 20px;
        text-align: center;
        border: 1px dashed rgba(244, 196, 223, 0.45);
        border-radius: 9px;
        background: rgba(16, 29, 25, 0.65);
        color: #f4c4df;
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px;
    }

    .empty-state p {
        margin: 0;
    }

    .closing-note {
        text-align: center;
        margin-top: 30px;
        color: #e5dce1;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-size: 17px;
    }

    @media (max-width: 600px) {
        .container {
            padding: 22px 15px 35px;
        }

        header {
            padding: 25px 5px 20px;
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
            padding: 17px;
        }
    }
</style>
</head>

<body>
<div class="container">

<header>
    <span class="chapter">🦢</span>
    <h1>Chapter of Tasks</h1>
    <p>Take each day gently, and let every little progress bloom</p>
    <div class="quote-translation">
        One lovely step at a time.
    </div>
</header>


@if (session('success'))
<div class="success" id="success-message">
    🌷 {{ session('success') }}
</div>
@endif


<form class="form-card" action="{{ route('tasks.store') }}" method="POST">
@csrf

<label for="task_title">Task title:</label>
<input type="text" id="task_title" name="task_title"
value="{{ old('task_title') }}">

@error('task_title')
<p class="error">{{ $message }}</p>
@enderror

<label for="description">Description:</label>
<textarea id="description" name="description">{{ old('description') }}</textarea>

<button type="submit">+ Add Task</button>
</form>

<h2>Saved Tasks</h2>

@forelse ($tasks as $task)
<article>
<h3>{{ $task->task_title }}</h3>
<p>{{ $task->description ?: 'No description provided.' }}</p>
<p>Status: {{ $task->completed ? 'Completed' : 'Not completed' }}</p>
</article>
<hr>
@empty
<div class="empty-state">
    <p>❀ No tasks have been added yet. ❀</p>
</div>
@endforelse

<div class="closing-note">
    ✦ YOUR TASKS, YOUR JOURNEY ✦
</div>

</div>


<script>
    const successMessage = document.getElementById('success-message');

    if (successMessage) {
        setTimeout(() => {
            successMessage.remove();
        }, 3500);
    }
</script>

</body>
</html>
