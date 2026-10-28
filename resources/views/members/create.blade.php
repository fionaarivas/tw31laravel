<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register New Member</title>

    <style>
        * {
            box-sizing: border-box;
        }

       body {
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
            font-size: 30px;
            color: #26332f;
        }

        .subtitle {
            color: #71807a;
            margin-top: 8px;
            font-size: 15px;
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
            font-weight: bold;
            margin: 5px 0 24px;
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
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
            color: #26332f;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d7e3dd;
            border-radius: 9px;
            padding: 12px;
            font-size: 14px;
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

        .cancel-button,
        .save-button {
            border: none;
            padding: 12px 20px;
            border-radius: 9px;
            font-size: 14px;
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

        .save-button {
            background: #e875a8;
            color: white;
            font-weight: bold;
        }

        .save-button:hover {
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
                justify-content: stretch;
                flex-direction: column;
            }

            .cancel-button,
            .save-button {
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
                <h1>Register New Member</h1>

                <p class="subtitle">
                    Add a new member to the membership system.
                </p>
            </div>

            <a
                href="{{ route('members.index') }}"
                class="back-button"
            >
                ← Back to Members
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
                action="{{ route('members.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label for="name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter full name"
                            required
                        >

                        @error('name')
                            <span class="error">
                                {{ $message }}
                            </span>
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
                            value="{{ old('email') }}"
                            placeholder="example@email.com"
                            required
                        >

                        @error('email')
                            <span class="error">
                                {{ $message }}
                            </span>
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
                            value="{{ old('phone_number') }}"
                            placeholder="09XXXXXXXXX"
                            required
                        >

                        @error('phone_number')
                            <span class="error">
                                {{ $message }}
                            </span>
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
                            <option value="">
                                Select category
                            </option>

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
                            <span class="error">
                                {{ $message }}
                            </span>
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
                            <option value="">
                                Select level
                            </option>

                            @foreach ($levels as $level)
                                <option
                                    value="{{ $level->id }}"
                                    {{ old('membership_level_id') == $level->id ? 'selected' : '' }}
                                >
                                    {{ $level->name }} —
                                    ₱{{ number_format($level->fee, 2) }}
                                </option>
                            @endforeach
                        </select>

                        @error('membership_level_id')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="address">
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            placeholder="Enter complete address"
                            required
                        >{{ old('address') }}</textarea>

                        @error('address')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="button-row">

                    <a
                        href="{{ route('members.index') }}"
                        class="cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="save-button"
                    >
                        Save Member
                    </button>

                </div>
            </form>

        </div>

    </main>

</body>
</html>