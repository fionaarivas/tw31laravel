<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Membership Category</title>

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

        .profile-card {
            background: white;
            padding: 32px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, 0.08);
        }

        .card-title {
            color: #337a4b;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .detail-box {
            background: #f8fbf9;
            border: 1px solid #e1ebe5;
            border-radius: 10px;
            padding: 17px;
            margin-bottom: 16px;
        }

        .detail-label {
            color: #71807a;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 17px;
            font-weight: 600;
            line-height: 1.6;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status.active {
            background: #e4f5e7;
            color: #337a4b;
        }

        .status.inactive {
            background: #fff0f4;
            color: #b83e64;
        }

        .button-row {
            display: flex;
            gap: 12px;
            margin-top: 25px;
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

        .back-bottom-button {
            background: #eef3f0;
            color: #52635b;
        }

        .back-bottom-button:hover {
            background: #dfe9e4;
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

            .profile-card {
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
                <h1>Membership Category</h1>

                <p class="subtitle">
                    View the details of this membership category.
                </p>
            </div>

            <a
                    href="{{ route('membership-categories.index') }}"
                    class="back-button"
                >
                    ← Back to Categories
                </a>
        </div>

        <div class="profile-card">

            <div class="card-title">
                Category Information
            </div>

            <div class="detail-box">
                <div class="detail-label">
                    Category Name
                </div>

                <div class="detail-value">
                    {{ $membershipCategory->name }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">
                    Description
                </div>

                <div class="detail-value">
                    {{ $membershipCategory->description ?? 'No description available.' }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">
                    Status
                </div>

                @if ($membershipCategory->is_active)
                    <span class="status active">
                        Active
                    </span>
                @else
                    <span class="status inactive">
                        Inactive
                    </span>
                @endif
            </div>

            
            </div>

        </div>

    </main>

</body>
</html>