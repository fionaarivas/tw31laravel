<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Member</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263238;
        }

        .container {
            width: 92%;
            max-width: 750px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #1f3c88;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .error {
            margin-top: 5px;
            color: #dc2626;
            font-size: 14px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button,
        .back-link {
            border: none;
            border-radius: 7px;
            padding: 12px 18px;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #1f3c88;
            color: white;
        }

        .back-link {
            background: #e5e7eb;
            color: #263238;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>Add New Member</h1>

            <form action="{{ route('members.store') }}" method="POST">
                @csrf

                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="phone_number">Phone Number</label>
                <input
                    type="text"
                    id="phone_number"
                    name="phone_number"
                    value="{{ old('phone_number') }}"
                >
                @error('phone_number')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="address">Address</label>
                <textarea id="address" name="address">{{ old('address') }}</textarea>
                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="membership_category_id">
                    Membership Category
                </label>

                <select name="membership_category_id" id="membership_category_id">
                    <option value="">Select category</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('membership_category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('membership_category_id')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="membership_level_id">
                    Membership Level
                </label>

                <select name="membership_level_id" id="membership_level_id">
                    <option value="">Select level</option>

                    @foreach ($levels as $level)
                        <option
                            value="{{ $level->id }}"
                            {{ old('membership_level_id') == $level->id ? 'selected' : '' }}
                        >
                            {{ $level->name }} -
                            ₱{{ number_format($level->fee, 2) }}
                        </option>
                    @endforeach
                </select>

                @error('membership_level_id')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="buttons">
                    <button type="submit">Save Member</button>
                    <a href="{{ route('members.index') }}" class="back-link">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>