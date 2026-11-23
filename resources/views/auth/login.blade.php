<x-guest-layout class="is-narrow">

    <x-slot name="title">Sign In · Membership Management System</x-slot>

    <x-slot name="aside">
        <span class="aside-eyebrow">Member Portal</span>

        <h2>Welcome back! We're glad to see you.</h2>

        <p>
            Sign in to your member portal to check your membership status,
            keep track of your assigned tasks, and review your transactions
            and payments.
        </p>

        <ul class="aside-points">
            <li><span>✓</span> View your membership details</li>
            <li><span>✓</span> Update the status of your tasks</li>
            <li><span>✓</span> Review your payment history</li>
        </ul>
    </x-slot>

    <div class="auth-heading">
        <h1>Sign in</h1>
        <p>Enter your email and password to access your account.</p>
    </div>

    <x-auth-session-status
        class="auth-status"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
        @csrf

        <div class="field">
            <x-input-label for="email" :value="__('Email Address')" />

            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="you@example.com"
                :aria-invalid="$errors->has('email') ? 'true' : 'false'"
                aria-describedby="email-error"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                id="email-error"
                :messages="$errors->get('email')"
            />
        </div>

        <div class="field">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                type="password"
                name="password"
                placeholder="Enter your password"
                :aria-invalid="$errors->has('password') ? 'true' : 'false'"
                aria-describedby="password-error"
                required
                autocomplete="current-password"
            />

            <x-input-error
                id="password-error"
                :messages="$errors->get('password')"
            />
        </div>

        <div class="form-row">
            <label for="remember_me" class="auth-check">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="auth-btn">
            Log in
        </button>

        @if (Route::has('register'))
            <p class="auth-switch">
                Don't have a membership account yet?
                <a class="auth-link" href="{{ route('register') }}">Register for Membership</a>
            </p>
        @endif
    </form>

</x-guest-layout>
