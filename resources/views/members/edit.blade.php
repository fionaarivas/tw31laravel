<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Member</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f8faf9;
            color: #26332f;
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
        }

        .content {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
            padding: 45px 35px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .subtitle {
            color: #71807a;
            margin-top: 8px;
        }

        .back-button {
            background: white;
            color: #337a4b;
            border: 1px solid #cfe0d7;
            padding: 11px 17px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
        }

        .back-button:hover {
            background: #eef7f1;
        }

        .form-card {
            background: white;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, 0.08);
        }

        .section-title {
            color: #337a4b;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d7e3dd;
            border-radius: 9px;
            padding: 12px;
            font-size: 14px;
            font-family: inherit;
            color: #26332f;
            background: #fbfdfc;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #86c98b;
            box-shadow: 0 0 0 3px rgba(134, 201, 139, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        .error {
            color: #d95378;
            font-size: 13px;
            margin-top: 5px;
        }

        .general-errors {
            background: #fff0f4;
            color: #b83e64;
            border: 1px solid #f2bfd0;
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 22px;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            border: none;
            padding: 12px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
        }

        .cancel-button {
            background: #eef3f0;
            color: #52635b;
        }

        .cancel-button:hover {
            background: #dfe9e4;
        }

        .update-button {
            background: #e875a8;
            color: white;
            font-weight: 600;
        }

        .update-button:hover {
            background: #d95f94;
        }

        @media (max-width: 700px) {
            .content {
                padding: 25px 18px;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .form-card {
                padding: 22px;
            }

            .button-row {
                flex-direction: column;
            }

            .button {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <main class="content">

        <div class="top-section">
            <div>
                <h1>Edit Member</h1>

                <p class="subtitle">
                    Update the member's information.
                </p>
            </div>

            <a
                href="{{ route('members.show', $member) }}"
                class="back-button"
            >
                ← Back to Profile
            </a>
        </div>

        <div class="form-card">

            @if ($errors->any())
                <div class="general-errors">
                    Please correct the errors below.
                </div>
            @endif

            <div class="section-title">
                Member Information
            </div>

            <form
                action="{{ route('members.update', $member) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="form-grid">

                    <div class="form-group">
                        <label for="membership_number">
                            Membership Number
                        </label>

                        <input
                            type="text"
                            id="membership_number"
                            name="membership_number"
                            value="{{ old('membership_number', $member->membership_number) }}"
                            required
                        >

                        @error('membership_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            required
                        >
                            <option
                                value="active"
                                {{ old('status', $member->status) === 'active' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                {{ old('status', $member->status) === 'inactive' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>
                        </select>

                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $member->name) }}"
                            required
                        >

                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $member->email) }}"
                            required
                        >

                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            id="phone_number"
                            name="phone_number"
                            value="{{ old('phone_number', $member->phone_number) }}"
                            required
                        >

                        @error('phone_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="membership_category_id">
                            Membership Category
                        </label>

                        <select
                            name="membership_category_id"
                            id="membership_category_id"
                            required
                        >
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('membership_category_id', $member->membership_category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('membership_category_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="membership_level_id">
                            Membership Level
                        </label>

                        <select
                            name="membership_level_id"
                            id="membership_level_id"
                            required
                        >
                            @foreach ($levels as $level)
                                <option
                                    value="{{ $level->id }}"
                                    {{ old('membership_level_id', $member->membership_level_id) == $level->id ? 'selected' : '' }}
                                >
                                    {{ $level->name }} —
                                    ₱{{ number_format($level->fee, 2) }}
                                </option>
                            @endforeach
                        </select>

                        @error('membership_level_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="address">
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            required
                        >{{ old('address', $member->address) }}</textarea>

                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="button-row">

                    <a
                        href="{{ route('members.show', $member) }}"
                        class="button cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="button update-button"
                    >
                        Update Member
                    </button>

                </div>
            </form>

        </div>

    </main>

</body>
</html>