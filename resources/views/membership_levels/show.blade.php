<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Membership Level</title>

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

        h1,
        h2,
        h3,
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

        .profile-card {
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
            margin-bottom: 24px;
        }

        .level-name {
            color: #337a4b;
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-box {
            background: #f8fbf9;
            border: 1px solid #e1ebe5;
            border-radius: 10px;
            padding: 17px;
        }

        .detail-label {
            color: #71807a;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .detail-value {
            color: #26332f;
            font-size: 17px;
            font-weight: 600;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .benefits-box {
            background: #fff5f8;
            border-left: 4px solid #e875a8;
            border-radius: 9px;
            padding: 17px;
            margin-top: 20px;
        }

        .benefits-title {
            color: #b83e64;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .benefits-text {
            color: #52635b;
            line-height: 1.6;
            white-space: pre-line;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status.active {
            background: #e2f4e4;
            color: #337a4b;
        }

        .status.inactive {
            background: #fff0f4;
            color: #b83e64;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            border-radius: 9px;
            padding: 12px 20px;
            font-size: 14px;
            text-decoration: none;
        }

        .back-bottom-button {
            background: #eef3f0;
            color: #52635b;
        }

        .back-bottom-button:hover {
            background: #dfe9e4;
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

            .profile-card {
                padding: 22px;
            }

            .details-grid {
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
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <main class="content">

        <div class="top-section">

            <div>
                <h1>Membership Level</h1>

                <p class="subtitle">
                    View complete membership level information.
                </p>
            </div>

            <a
                href="{{ route('membership-levels.index') }}"
                class="back-button"
            >
                ← Back to Levels
            </a>

        </div>

        <div class="profile-card">

            <div class="section-title">
                Level Information
            </div>

            <div class="level-name">
                {{ $membershipLevel->name }}
            </div>

            <div class="details-grid">

                <div class="detail-box">
                    <div class="detail-label">
                        Membership Fee
                    </div>

                    <div class="detail-value">
                        ₱{{ number_format($membershipLevel->fee, 2) }}
                    </div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">
                        Validity Period
                    </div>

                    <div class="detail-value">
                        {{ $membershipLevel->validity_period_months }}
                        month(s)
                    </div>
                </div>

                <div class="detail-box full-width">
                    <div class="detail-label">
                        Status
                    </div>

                    @if ($membershipLevel->is_active)
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

            <div class="benefits-box">
                <div class="benefits-title">
                    Membership Benefits
                </div>

                <div class="benefits-text">
                    {{ $membershipLevel->benefits ?? 'No benefits listed.' }}
                </div>
            </div>

            </div>

        </div>

    </main>

</body>
</html>