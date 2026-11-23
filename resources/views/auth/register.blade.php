<x-guest-layout>

    <x-slot name="title">Register for Membership · Membership Management System</x-slot>

    <x-slot name="aside">
        <span class="aside-eyebrow">Become a Member</span>

        <h2>Join our community in a few simple steps.</h2>

        <p>
            Create your account and send in your membership application.
            Once an administrator reviews and approves it, your membership
            becomes active.
        </p>

        <ul class="aside-points">
            <li><span>1</span> Fill in your personal details</li>
            <li><span>2</span> Choose your membership plan</li>
            <li><span>3</span> Wait for admin approval</li>
        </ul>
    </x-slot>

    <div class="auth-heading">
        <h1>Register for Membership</h1>
        <p>
            Create your member account and submit your membership application.
            All fields are required unless marked optional.
        </p>
    </div>

    @if ($errors->any())
        <div class="auth-error-summary" role="alert">
            Please review the highlighted fields below and try again.
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
        @csrf

        {{-- Personal information --}}
        <div class="form-section">
            <h2 class="form-section-title">Personal Information</h2>

            <div class="field-grid">
                <div class="field span-2">
                    <x-input-label for="name" :value="__('Full Name')" />

                    <x-text-input
                        id="name"
                        type="text"
                        name="name"
                        :value="old('name')"
                        placeholder="Juan Dela Cruz"
                        :aria-invalid="$errors->has('name') ? 'true' : 'false'"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="field">
                    <x-input-label for="email" :value="__('Email Address')" />

                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="you@example.com"
                        :aria-invalid="$errors->has('email') ? 'true' : 'false'"
                        required
                        autocomplete="email"
                    />

                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="field">
                    <x-input-label for="phone_number" :value="__('Phone Number')" />

                    <x-text-input
                        id="phone_number"
                        type="text"
                        name="phone_number"
                        :value="old('phone_number')"
                        placeholder="09XX XXX XXXX"
                        :aria-invalid="$errors->has('phone_number') ? 'true' : 'false'"
                        required
                        autocomplete="tel"
                    />

                    <x-input-error :messages="$errors->get('phone_number')" />
                </div>

                <div class="field span-2">
                    <x-input-label for="address" :value="__('Address')" />

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="House no., street, barangay, city, province"
                        aria-invalid="{{ $errors->has('address') ? 'true' : 'false' }}"
                        required
                        autocomplete="street-address"
                    >{{ old('address') }}</textarea>

                    <x-input-error :messages="$errors->get('address')" />
                </div>

                <div class="field span-2">
                    <x-input-label for="location-map" :value="__('Location (optional)')" />

                    <p class="field-hint">
                        Click the map or drag the marker to pin your location.
                    </p>

                    <div id="location-map" class="map-box"></div>

                    <input
                        type="hidden"
                        id="latitude"
                        name="latitude"
                        value="{{ old('latitude') }}"
                    >

                    <input
                        type="hidden"
                        id="longitude"
                        name="longitude"
                        value="{{ old('longitude') }}"
                    >

                    <x-input-error :messages="$errors->get('latitude')" />
                    <x-input-error :messages="$errors->get('longitude')" />
                </div>
            </div>
        </div>

        {{-- Membership plan --}}
        <div class="form-section">
            <h2 class="form-section-title">Membership Plan</h2>

            <div class="field-grid">
                <div class="field">
                    <x-input-label for="membership_category_id" :value="__('Membership Category')" />

                    <select
                        id="membership_category_id"
                        name="membership_category_id"
                        aria-invalid="{{ $errors->has('membership_category_id') ? 'true' : 'false' }}"
                        required
                    >
                        <option value="">Select a category</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected(old('membership_category_id') == $category->id)
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('membership_category_id')" />
                </div>

                <div class="field">
                    <x-input-label for="membership_level_id" :value="__('Membership Level')" />

                    <select
                        id="membership_level_id"
                        name="membership_level_id"
                        aria-invalid="{{ $errors->has('membership_level_id') ? 'true' : 'false' }}"
                        required
                    >
                        <option value="">Select a level</option>

                        @foreach ($levels as $level)
                            <option
                                value="{{ $level->id }}"
                                @selected(old('membership_level_id') == $level->id)
                            >
                                {{ $level->name }} — ₱{{ number_format($level->fee, 2) }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('membership_level_id')" />
                </div>
            </div>
        </div>

        {{-- Account security --}}
        <div class="form-section">
            <h2 class="form-section-title">Account Security</h2>

            <div class="field-grid">
                <div class="field">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Create a password"
                        :aria-invalid="$errors->has('password') ? 'true' : 'false'"
                        required
                        autocomplete="new-password"
                    />

                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div class="field">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Re-enter your password"
                        :aria-invalid="$errors->has('password_confirmation') ? 'true' : 'false'"
                        required
                        autocomplete="new-password"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </div>
            </div>
        </div>

        <div style="margin-top: 28px;">
            <button type="submit" class="auth-btn">
                Register for Membership
            </button>
        </div>

        <p class="auth-switch">
            Already have an account?
            <a class="auth-link" href="{{ route('login') }}">Sign in</a>
        </p>
    </form>

    <script>
        let registrationMap;
        let registrationMarker;

        function initRegistrationMap() {
            const oldLatitude = Number(
                @json(old('latitude', 14.5995))
            );

            const oldLongitude = Number(
                @json(old('longitude', 120.9842))
            );

            const defaultLocation = {
                lat: oldLatitude,
                lng: oldLongitude
            };

            registrationMap = new google.maps.Map(
                document.getElementById('location-map'),
                {
                    center: defaultLocation,
                    zoom: 13,
                    mapTypeControl: true,
                    streetViewControl: false,
                    fullscreenControl: true
                }
            );

            registrationMarker = new google.maps.Marker({
                position: defaultLocation,
                map: registrationMap,
                draggable: true
            });

            updateRegistrationCoordinates(
                defaultLocation.lat,
                defaultLocation.lng
            );

            registrationMap.addListener('click', function (event) {
                const location = event.latLng;

                registrationMarker.setPosition(location);

                updateRegistrationCoordinates(
                    location.lat(),
                    location.lng()
                );
            });

            registrationMarker.addListener('dragend', function () {
                const location = registrationMarker.getPosition();

                updateRegistrationCoordinates(
                    location.lat(),
                    location.lng()
                );
            });
        }

        function updateRegistrationCoordinates(latitude, longitude) {
            document.getElementById('latitude').value = latitude.toFixed(7);
            document.getElementById('longitude').value = longitude.toFixed(7);
        }
    </script>

    <script
        async
        defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initRegistrationMap"
    ></script>

</x-guest-layout>
