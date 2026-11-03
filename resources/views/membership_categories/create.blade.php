<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Membership Category</title>

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
            max-width: 900px;
            margin: 0 auto;
            padding: 50px 30px;
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

        .category-notice {
            background: #eef7f1;
            border: 1px solid #cfe5d5;
            color: #337a4b;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .category-notice strong {
            font-size: 15px;
        }

        .category-notice p {
            color: #71807a;
            margin: 8px 0 14px;
        }

        .existing-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .existing-category {
            display: flex;
            align-items: center;
            gap: 7px;
            background: white;
            border: 1px solid #d7e8dc;
            padding: 8px 11px;
            border-radius: 20px;
            color: #26332f;
        }

        .existing-category span {
            font-weight: 600;
        }

        .existing-category small {
            font-size: 11px;
            font-weight: 600;
        }

        .active-label {
            color: #337a4b;
        }

        .inactive-label {
            color: #b83e64;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
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
            font-family: inherit;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #86c98b;
            box-shadow: 0 0 0 3px rgba(134, 201, 139, 0.2);
        }

        textarea {
            min-height: 130px;
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

        @media (max-width: 600px) {
            .content {
                padding: 25px 18px;
            }

            .top-section {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
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
                <h1>Add Membership Category</h1>

                <p class="subtitle">
                    Create a new category for your members.
                </p>
            </div>

            <a
                href="{{ route('membership-categories.index') }}"
                class="back-button"
            >
                ← Back to Categories
            </a>
        </div>

        <div class="form-card">

            @if ($errors->any())
                <div class="general-errors">
                    Please correct the errors below.
                </div>
            @endif

            <div class="section-title">
                Category Information
            </div>

            <div class="category-notice">
                <strong>Existing membership categories</strong>

                <p>
                    Category names must be unique. Please choose a name that
                    is not already listed below.
                </p>

                <div class="existing-categories">
                    @forelse ($existingCategories as $existingCategory)
                        <div class="existing-category">
                            <span>
                                {{ $existingCategory->name }}
                            </span>

                            @if ($existingCategory->is_active)
                                <small class="active-label">
                                    Active
                                </small>
                            @else
                                <small class="inactive-label">
                                    Inactive
                                </small>
                            @endif
                        </div>
                    @empty
                        <span>
                            No categories have been added yet.
                        </span>
                    @endforelse
                </div>
            </div>

            <form
                action="{{ route('membership-categories.store') }}"
                method="POST"
            >
                @csrf

                <div class="form-group">
                    <label for="name">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Example: Corporate"
                        required
                    >

                    <small class="input-help">
                        Example categories: Student, Regular, Senior Citizen,
                        or Corporate.
                    </small>

                    @error('name')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Enter a short description of this category"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <span class="error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="button-row">

                    <a
                        href="{{ route('membership-categories.index') }}"
                        class="button cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="button save-button"
                    >
                        Save Category
                    </button>

                </div>
            </form>

        </div>

    </main>

</body>
</html>