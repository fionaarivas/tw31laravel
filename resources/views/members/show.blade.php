<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Member Profile</title>

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
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(34, 70, 58, 0.08);
            margin-bottom: 22px;
        }

        .card-title {
            color: #337a4b;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 22px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-box {
            background: #f8fbf9;
            border: 1px solid #e1ebe5;
            border-radius: 10px;
            padding: 16px;
        }

        .detail-label {
            color: #71807a;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: bold;
            color: #26332f;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status.active {
            background: #e4f5e7;
            color: #337a4b;
        }

        .status.inactive {
            background: #fff0f4;
            color: #b83e64;
        }

        .membership-card {
            border: 1px solid #dce9df;
            border-radius: 13px;
            padding: 22px;
            background: #fbfdfc;
        }

        .membership-name {
            font-size: 22px;
            color: #337a4b;
            font-weight: bold;
            margin-bottom: 16px;
        }

        .membership-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .membership-item {
            padding: 14px;
            background: white;
            border-radius: 9px;
            border: 1px solid #e1ebe5;
        }

        .membership-item span {
            display: block;
            color: #71807a;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .membership-item strong {
            color: #26332f;
            font-size: 16px;
        }

        .benefits {
            margin-top: 18px;
            padding: 16px;
            background: #fff5f8;
            border-left: 4px solid #e875a8;
            border-radius: 8px;
        }

        .benefits-title {
            color: #b83e64;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .benefits-text {
            color: #52635b;
            line-height: 1.6;
            white-space: pre-line;
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
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .edit-button {
            background: #e875a8;
            color: white;
        }

        .edit-button:hover {
            background: #d95f94;
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

            .details-grid,
            .membership-details {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .profile-card {
                padding: 22px;
            }

            .button-row {
                flex-direction: column;
            }

            .button {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <main class="content">

        <div class="top-section">
            <div>
                <h1>Member Profile</h1>

                <p class="subtitle">
                    View complete membership information.
                </p>
            </div>

            <a
                href="{{ route('members.index') }}"
                class="back-button"
            >
                ← Back to Members
            </a>
        </div>

        <section class="profile-card">

            <div class="card-title">
                Personal Information
            </div>

            <div class="details-grid">

                <div class="detail-box">
                    <div class="detail-label">
                        Membership Number
                    </div>

                    <div class="detail-value">
                        {{ $member->membership_number }}
                    </div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">
                        Status
                    </div>

                    <span class="status {{ $member->status }}">
                        {{ $member->status }}
                    </span>
                </div>

                <div class="detail-box">
                    <div class="detail-label">
                        Full Name
                    </div>

                    <div class="detail-value">
                        {{ $member->name }}
                    </div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">
                        Email Address
                    </div>

                    <div class="detail-value">
                        {{ $member->email }}
                    </div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">
                        Phone Number
                    </div>

                    <div class="detail-value">
                        {{ $member->phone_number }}
                    </div>
                </div>

                <div class="detail-box full-width">
                    <div class="detail-label">
                        Address
                    </div>

                    <div class="detail-value">
                        {{ $member->address }}
                    </div>
                </div>

            </div>
        </section>

        <section class="profile-card">

            <div class="card-title">
                Membership Information
            </div>

            <div class="membership-card">

                <div class="membership-name">
                    {{ $member->membershipLevel->name ?? 'No Level Assigned' }}
                </div>

                <div class="membership-details">

                    <div class="membership-item">
                        <span>Category</span>

                        <strong>
                            {{ $member->membershipCategory->name ?? 'No Category Assigned' }}
                        </strong>
                    </div>

                    <div class="membership-item">
                        <span>Category Description</span>

                        <strong>
                            {{ $member->membershipCategory->description ?? 'No description available.' }}
                        </strong>
                    </div>

                    <div class="membership-item">
                        <span>Membership Fee</span>

                        <strong>
                            ₱{{ number_format($member->membershipLevel->fee ?? 0, 2) }}
                        </strong>
                    </div>

                    <div class="membership-item">
                        <span>Validity Period</span>

                        <strong>
                            {{ $member->membershipLevel->validity_period_months ?? 0 }}
                            month(s)
                        </strong>
                    </div>

                </div>

                <div class="benefits">
                    <div class="benefits-title">
                        Membership Benefits
                    </div>

                    <div class="benefits-text">
                        {{ $member->membershipLevel->benefits ?? 'No benefits listed.' }}
                    </div>
                </div>

            </div>
        </section>


    </main>

</body>
</html>