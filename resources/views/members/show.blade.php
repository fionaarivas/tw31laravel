<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Member Profile</title>

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
            --blue: #78c9dd;
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
        .profile-card,
        .weather-card {
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

        .profile-card,
        .weather-card {
            margin-bottom: 22px;
            padding: 30px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(24, 21, 28, .96);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .24);
        }

        .card-title {
            margin-bottom: 22px;
            color: var(--pink);
            font-size: 20px;
            font-weight: 700;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-box {
            padding: 17px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 12px;
            background: var(--panel-light);
        }

        .detail-label {
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .detail-value {
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .full-width {
            grid-column: 1 / -1;
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
            text-transform: capitalize;
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

        .membership-card {
            padding: 22px;
            border: 1px solid rgba(233, 132, 197, .22);
            border-radius: 14px;
            background:
                linear-gradient(
                    135deg,
                    rgba(233, 132, 197, .08),
                    rgba(142, 81, 157, .09)
                );
        }

        .membership-name {
            margin-bottom: 16px;
            color: var(--pink);
            font-size: 24px;
            font-weight: 750;
        }

        .membership-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .membership-item {
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 10px;
            background: rgba(28, 24, 33, .85);
        }

        .membership-item span {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 12px;
        }

        .membership-item strong {
            display: block;
            color: var(--text);
            font-size: 15px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .benefits {
            margin-top: 18px;
            padding: 17px;
            border: 1px solid rgba(233, 132, 197, .24);
            border-left: 4px solid var(--pink);
            border-radius: 10px;
            background: rgba(233, 132, 197, .08);
        }

        .benefits-title {
            margin-bottom: 8px;
            color: var(--pink);
            font-weight: 700;
        }

        .benefits-text {
            color: var(--muted);
            line-height: 1.6;
            white-space: pre-line;
        }

        .weather-content {
            display: flex;
            align-items: center;
            gap: 25px;
            padding: 20px;
            border: 1px solid rgba(120, 201, 221, .23);
            border-radius: 14px;
            background: rgba(120, 201, 221, .07);
        }

        .weather-icon {
            width: 85px;
            height: 85px;
        }

        .weather-location {
            margin-bottom: 6px;
            color: var(--blue);
            font-size: 22px;
            font-weight: 750;
        }

        .weather-temperature {
            color: var(--text);
            font-size: 30px;
            font-weight: 750;
        }

        .weather-description {
            margin: 4px 0 12px;
            color: var(--muted);
            text-transform: capitalize;
        }

        .weather-details {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            color: var(--muted);
            font-size: 13px;
        }

        .weather-details strong {
            color: var(--text);
        }

        .weather-loading,
        .weather-error,
        .no-weather {
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 10px;
            background: var(--panel-light);
            color: var(--muted);
        }

        .weather-error {
            border-color: rgba(240, 141, 168, .3);
            background: rgba(240, 141, 168, .1);
            color: var(--red);
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            gap: 11px;
            margin-top: 25px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 20px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .history-button {
            background: rgba(120, 201, 221, .14);
            color: var(--blue);
        }

        .history-button:hover {
            background: rgba(120, 201, 221, .25);
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

            .profile-card,
            .weather-card {
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

            .profile-card,
            .weather-card {
                padding: 22px 18px;
            }

            .details-grid,
            .membership-details {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .weather-content {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
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
                    Member directory
                </p>

                <h1>
                    Member Profile
                </h1>

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

        <section class="weather-card">

            <div class="card-title">
                Current Weather
            </div>

            @if ($member->latitude !== null && $member->longitude !== null)

                <div
                    id="weather-loading"
                    class="weather-loading"
                >
                    Loading current weather...
                </div>

                <div
                    id="weather-error"
                    class="weather-error"
                    hidden
                ></div>

                <div
                    id="weather-content"
                    class="weather-content"
                    hidden
                >
                    <img
                        id="weather-icon"
                        class="weather-icon"
                        src=""
                        alt="Weather icon"
                    >

                    <div>
                        <div
                            id="weather-location"
                            class="weather-location"
                        ></div>

                        <div
                            id="weather-temperature"
                            class="weather-temperature"
                        ></div>

                        <div
                            id="weather-description"
                            class="weather-description"
                        ></div>

                        <div class="weather-details">

                            <span>
                                Humidity:
                                <strong id="weather-humidity"></strong>%
                            </span>

                            <span>
                                Wind:
                                <strong id="weather-wind"></strong> m/s
                            </span>

                            <span>
                                Feels like:
                                <strong id="weather-feels-like"></strong>°C
                            </span>

                        </div>
                    </div>
                </div>

            @else

                <div class="no-weather">
                    Weather information is unavailable because this member has no saved location.
                </div>

            @endif

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

            <div class="button-row">

                <a
                    href="{{ route('members.transactions', $member) }}"
                    class="button history-button"
                >
                    Transaction History
                </a>

            </div>

        </section>

    </main>

</div>

@if ($member->latitude !== null && $member->longitude !== null)

<script>
    const weatherUrl = @json(route('weather.show'));

    const latitude = @json($member->latitude);
    const longitude = @json($member->longitude);

    const loading = document.getElementById('weather-loading');
    const weatherContent = document.getElementById('weather-content');
    const errorBox = document.getElementById('weather-error');

    const params = new URLSearchParams({
        lat: latitude,
        lon: longitude
    });

    fetch(`${weatherUrl}?${params.toString()}`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.message || 'Unable to load weather information.'
            );
        }

        return data;
    })
    .then(data => {
        document.getElementById('weather-location').textContent =
            @json($member->address);

        document.getElementById('weather-temperature').textContent =
            `${data.temperature ?? '--'}°C`;

        document.getElementById('weather-description').textContent =
            data.description || 'No description available';

        document.getElementById('weather-humidity').textContent =
            data.humidity ?? '--';

        document.getElementById('weather-wind').textContent =
            data.wind_speed ?? '--';

        document.getElementById('weather-feels-like').textContent =
            data.feels_like ?? '--';

        if (data.icon) {
            document.getElementById('weather-icon').src =
                `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
        }

        loading.hidden = true;
        weatherContent.hidden = false;
    })
    .catch(error => {
        loading.hidden = true;
        errorBox.textContent = error.message;
        errorBox.hidden = false;
    });
</script>

@endif

</body>
</html>