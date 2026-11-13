<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Membership Category</title>

    <style>
        :root {
            --panel: #1c1821;
            --panel-light: #25202b;
            --border: rgba(255, 255, 255, .14);
            --text: #f8f4fa;
            --muted: #b8afbd;
            --pink: #e984c5;
            --pink-dark: #c967a8;
            --green: #72d69b;
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
        .profile-card {
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

        .profile-card {
            padding: 34px 36px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(24, 21, 28, .96);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .24);
        }

        .card-title {
            margin-bottom: 24px;
            color: var(--pink);
            font-size: 20px;
            font-weight: 700;
        }

        .detail-box {
            margin-bottom: 16px;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 12px;
            background: var(--panel-light);
        }

        .detail-box:last-of-type {
            margin-bottom: 0;
        }

        .detail-label {
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .detail-value {
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 31px;
            padding: 0 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .status.active {
            background: rgba(114, 214, 155, .14);
            color: var(--green);
        }

        .status.inactive {
            background: rgba(240, 141, 168, .14);
            color: var(--red);
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            gap: 11px;
            margin-top: 28px;
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

        .back-bottom-button {
            background: #302a36;
            color: #d7ceda;
        }

        .back-bottom-button:hover {
            background: #403747;
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

            .profile-card {
                max-width: 100%;
            }
        }

        @media (max-width: 600px) {
            .layout {
                display: block;
            }

            .main {
                padding: 25px 17px 40px;
            }

            h1 {
                font-size: 31px;
            }

            .profile-card {
                padding: 22px 18px;
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
                    Membership Category
                </h1>

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
                    {{
                        $membershipCategory->description
                        ?? 'No description available.'
                    }}
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

</div>

</body>
</html>