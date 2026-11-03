<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Membership Level</title>

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
            -moz-osx-font-smoothing: grayscale;
        }

        h1,
        h2,
        h3,
        button,
        input,
        textarea,
        a {
            font-family: inherit;
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
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.8px;
        }

        .subtitle {
            color: #71807a;
            margin-top: 9px;
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
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, 0.08);
        }

        .section-title {
            color: #337a4b;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .level-notice {
            background: #eef7f1;
            border: 1px solid #cfe5d5;
            color: #337a4b;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .level-notice p {
            color: #71807a;
            margin: 8px 0 14px;
        }

        .existing-levels {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .existing-level {
            background: white;
            border: 1px solid #d7e8dc;
            padding: 8px 11px;
            border-radius: 20px;
            color: #26332f;
            font-weight: 600;
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
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #d7e3dd;
            border-radius: 9px;
            background: #fbfdfc;
            color: #26332f;
            font-size: 14px;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #86c98b;
            box-shadow: 0 0 0 3px rgba(134, 201, 139, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .input-help {
            color: #71807a;
            font-size: 13px;
            margin-top: 6px;
        }

        .error {
            color: #d95378;
            font-size: 13px;
            margin-top: 6px;
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
            font-family: inherit;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
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
            font-weight: 600;
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
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <main class="content">

        <div class="top-section">

            <div>
                <h1>Add Membership Level</h1>

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
                <strong>Existing membership levels</strong>

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
                        <span>
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

</body>
</html>