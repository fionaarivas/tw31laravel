<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Member</title>

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
            margin-bottom: 25px;
            color: var(--pink);
            font-size: 20px;
            font-weight: 700;
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
        select,
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
        select:focus,
        textarea:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(233, 132, 197, .13);
        }

        select option {
            background: var(--panel-light);
            color: var(--text);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
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

        .map-help {
            margin: 0 0 10px;
            color: var(--muted);
            font-size: 12px;
        }

        #map {
            width: 100%;
            height: 330px;
            margin-bottom: 17px;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 11px;
            overflow: hidden;
        }

        .coordinates-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .button-row {
            display: flex;
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

        .update-button {
            background: linear-gradient(
                135deg,
                var(--pink),
                #bd71b5
            );
            color: #ffffff;
            box-shadow: 0 8px 18px rgba(233, 132, 197, .18);
        }

        .update-button:hover {
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

            .form-grid,
            .coordinates-grid {
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
                    Member directory
                </p>

                <h1>
                    Edit Member
                </h1>

                <p class="subtitle">
                    Update the member's information.
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
                            <span class="error">
                                {{ $message }}
                            </span>
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
                            <span class="error">
                                {{ $message }}
                            </span>
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
                            value="{{ old('email', $member->email) }}"
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
                            value="{{ old('phone_number', $member->phone_number) }}"
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
                            required
                        >{{ old('address', $member->address) }}</textarea>

                        @error('address')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group full-width">

                        <label>
                            Select Member Location
                        </label>

                        <p class="map-help">
                            Click on the map or drag the marker to update the
                            member's location.
                        </p>

                        <div id="map"></div>

                        <div class="coordinates-grid">

                            <div>
                                <label for="latitude">
                                    Latitude
                                </label>

                                <input
                                    type="text"
                                    id="latitude"
                                    name="latitude"
                                    value="{{ old('latitude', $member->latitude) }}"
                                    readonly
                                >
                            </div>

                            <div>
                                <label for="longitude">
                                    Longitude
                                </label>

                                <input
                                    type="text"
                                    id="longitude"
                                    name="longitude"
                                    value="{{ old('longitude', $member->longitude) }}"
                                    readonly
                                >
                            </div>

                        </div>

                        @error('latitude')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                        @error('longitude')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

                <div class="button-row">

                    <a
                        href="{{ route('members.index') }}"
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

</div>

<script>
    let map;
    let marker;

    function initMap() {
        const savedLatitude = Number(
            @json(old('latitude', $member->latitude ?? 14.5995))
        );

        const savedLongitude = Number(
            @json(old('longitude', $member->longitude ?? 120.9842))
        );

        const savedLocation = {
            lat: savedLatitude,
            lng: savedLongitude
        };

        map = new google.maps.Map(
            document.getElementById('map'),
            {
                center: savedLocation,
                zoom: 14,
                mapTypeControl: true,
                streetViewControl: false,
                fullscreenControl: true
            }
        );

        marker = new google.maps.Marker({
            position: savedLocation,
            map: map,
            draggable: true,
            title: 'Member location'
        });

        document.getElementById('latitude').value =
            savedLatitude.toFixed(7);

        document.getElementById('longitude').value =
            savedLongitude.toFixed(7);

        map.addListener('click', function (event) {
            marker.setPosition(event.latLng);
            updateCoordinates(event.latLng);
        });

        marker.addListener('dragend', function (event) {
            updateCoordinates(event.latLng);
        });
    }

    function updateCoordinates(location) {
        document.getElementById('latitude').value =
            location.lat().toFixed(7);

        document.getElementById('longitude').value =
            location.lng().toFixed(7);
    }
</script>

<script
    async
    defer
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap">
</script>

</body>
</html>