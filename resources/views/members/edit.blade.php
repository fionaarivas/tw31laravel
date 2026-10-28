<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Member</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            width: 92%;
            max-width: 700px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #1f3c88;
        }

        label {
            display: block;
            margin-top: 16px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }

        textarea {
            min-height: 100px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        button,
        a {
            display: inline-block;
            margin-top: 22px;
            padding: 11px 17px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #1f3c88;
            color: white;
        }

        a {
            background: #e5e7eb;
            color: #263238;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Edit Member</h1>

        <form action="{{ route('members.update', $member) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="membership_number">Membership Number</label>
            <input
                type="text"
                id="membership_number"
                name="membership_number"
                value="{{ old('membership_number', $member->membership_number) }}"
                readonly
            >
            @error('membership_number')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $member->name) }}"
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $member->email) }}"
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="phone_number">Phone Number</label>
            <input
                type="text"
                id="phone_number"
                name="phone_number"
                value="{{ old('phone_number', $member->phone_number) }}"
            >
            @error('phone_number')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="address">Address</label>
            <textarea id="address" name="address">{{ old('address', $member->address) }}</textarea>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="membership_category_id">Category</label>
            <select name="membership_category_id" id="membership_category_id">
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('membership_category_id', $member->membership_category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="membership_level_id">Level</label>
            <select name="membership_level_id" id="membership_level_id">
                @foreach ($levels as $level)
                    <option
                        value="{{ $level->id }}"
                        {{ old('membership_level_id', $member->membership_level_id) == $level->id ? 'selected' : '' }}
                    >
                        {{ $level->name }} - ₱{{ number_format($level->fee, 2) }}
                    </option>
                @endforeach
            </select>

            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="active" {{ $member->status === 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive" {{ $member->status === 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            <br>

            <button type="submit">Update Member</button>
            <a href="{{ route('members.index') }}">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>