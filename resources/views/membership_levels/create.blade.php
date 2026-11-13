<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Membership Level</title>

    <style>
        :root {
            --panel: #1c1821;
            --panel-light: #25202b;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --pink-dark: #c967a8;
            --red: #f08da8;
        }

        * {
            box-sizing: border-box;
            font-family: inherit;
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
                    #151219 0%,
                    #5c4e59 52%,
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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 34px 42px 60px;
        }

        .top-section,
        .form-card {
            width: 100%;
            max-width: 1080px;
            margin-left: auto;
            margin-right: auto;
        }

        .top-section {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 28px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--pink);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--text);
            font-size: 36px;
            letter-spacing: -.9px;
        }

        .subtitle {
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 43px;
            padding: 0 17px;
            border: 1px solid rgba(233, 132, 197, .45);
            border-radius: 10px;
            background: rgba(233, 132, 197, .08);
            color: var(--pink);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: .2s ease;
        }

        .back-button:hover {
            background: rgba(233, 132, 197, .18);
            transform: translateY(-1px);
        }

        .form-card {
            padding: 34px 36px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(24, 21, 28, .96);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .24);
        }

        .section-title {
            margin-bottom: 24px;
            color: var(--pink);
            font-size: 20px;
            font-weight: 700;
        }

        .level-notice {
            margin-bottom: 27px;
            padding: 17px;
            border: 1px solid rgba(233, 132, 197, .32);
            border-radius: 12px;
            background:
                linear-gradient(
                    135deg,
                    rgba(233, 132, 197, .12),
                    rgba(142, 81, 157, .10)
                );
        }

        .level-notice strong {
            color: var(--pink);
            font-size: 14px;
        }

        .level-notice p {
            margin: 8px 0 15px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .existing-levels {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .existing-level {
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 20px;
            background: rgba(255, 255, 255, .05);
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 8px;
            color: #eee7f1;
            font-size: 13px;
            font-weight: 700;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 10px;
            outline: none;
            background: var(--panel-light);
            color: var(--text);
            font-size: 14px;
            transition: .2s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: #8e8795;
        }

        input:focus,
        textarea:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(233, 132, 197, .13);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .input-help {
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
        }

        .error {
            margin-top: 7px;
            color: var(--red);
            font-size: 12px;
        }

        .general-errors {
            margin-bottom: 22px;
            padding: 13px 15px;
            border: 1px solid rgba(240, 141, 168, .3);
            border-radius: 10px;
            background: rgba(240, 141, 168, .1);
            color: var(--red);
            font-size: 13px;
        }

        .button-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 11px;
            margin-top: 30px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 20px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .cancel-button {
            background: #302a36;
            color: #d7ceda;
        }

        .cancel-button:hover {
            background: #403747;
            transform: translateY(-1px);
        }

        .save-button {
            background: linear-gradient(
                135deg,
                var(--pink),
                #bd71b5
            );
            color: #ffffff;
            box-shadow: 0 8px 18px rgba(233, 132, 197, .18);
        }

        .save-button:hover {
            background: var(--pink-dark);
            transform: translateY(-1px);
        }

        @media (max-width: 900px) {
            .main {
                padding: 30px 25px 50px;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
            }

            .back-button {
                width: 100%;
            }

            .form-card {
                max-width: 100%;
            }
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .main {
                padding: 25px 17px 40px;
            }

            h1 {
                font-size: 31px;
            }

            .form-card {
                padding: 22px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .button-row {
                flex-direction: column;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.sidebar')

    <main class="main">

        <div class="top-section">

            <div>
                <p class="eyebrow">
                    Member settings
                </p>

                <h1>
                    Add Membership Level
                </h1>

                <p class="subtitle">
                    Create a membership package with its fee and benefits.
                </p>
            </div>

            <a
                href="{{ route('membership-levels.index') }}"
                class="back-button"
            >
                ← Back to Levels
            </a>

        </div>

        <div class="form-card">

            @if ($errors->any())
                <div class="general-errors">
                    Please correct the errors below.
                </div>
            @endif

            <div class="section-title">
                Level Information
            </div>

            <div class="level-notice">

                <strong>
                    Existing membership levels
                </strong>

                <p>
                    Level names must be unique. Please choose a level name
                    that is not already listed below.
                </p>

                <div class="existing-levels">

                    @forelse ($existingLevels as $existingLevel)

                        <div class="existing-level">
                            {{ $existingLevel->name }}
                        </div>

                    @empty

                        <span class="subtitle">
                            No membership levels have been added yet.
                        </span>

                    @endforelse

                </div>
            </div>

            <form
                action="{{ route('membership-levels.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-grid">

                    <div class="form-group">

                        <label for="name">
                            Level Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Example: Platinum"
                            required
                        >

                        <small class="input-help">
                            Example: Basic, Silver, Gold, or Platinum.
                        </small>

                        @error('name')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label for="fee">
                            Membership Fee
                        </label>

                        <input
                            type="number"
                            id="fee"
                            name="fee"
                            value="{{ old('fee') }}"
                            placeholder="2500.00"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('fee')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label for="validity_period_months">
                            Validity Period
                        </label>

                        <input
                            type="number"
                            id="validity_period_months"
                            name="validity_period_months"
                            value="{{ old('validity_period_months') }}"
                            placeholder="12"
                            min="1"
                            required
                        >

                        <small class="input-help">
                            Enter the number of months.
                        </small>

                        @error('validity_period_months')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group full-width">

                        <label for="benefits">
                            Membership Benefits
                        </label>

                        <textarea
                            id="benefits"
                            name="benefits"
                            placeholder="Enter the benefits included in this level"
                        >{{ old('benefits') }}</textarea>

                        @error('benefits')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

                <div class="button-row">

                    <a
                        href="{{ route('membership-levels.index') }}"
                        class="button cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="button save-button"
                    >
                        Save Level
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>