<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Membership Management System' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            color-scheme: dark;

            --cream: #111016;
            --paper: #1c1821;
            --lavender: #141117;
            --lavender-2: rgba(233, 132, 197, .4);
            --pink: rgba(233, 132, 197, .12);
            --pink-2: #e984c5;
            --purple: #e984c5;
            --purple-2: #b04892;
            --plum: #ffffff;
            --text: #f8f4fa;
            --muted: #a99faf;
            --label: #c9c1ce;
            --border: rgba(255, 255, 255, .12);
            --border-pink: rgba(233, 132, 197, .22);
            --focus: rgba(233, 132, 197, .22);
            --danger: #ff7aa8;
            --danger-bg: rgba(255, 122, 168, .1);
            --success: #f5b8de;
            --success-bg: rgba(233, 132, 197, .12);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 8% 12%, rgba(133, 82, 145, .16), transparent 32%),
                radial-gradient(circle at 92% 88%, rgba(233, 132, 197, .1), transparent 34%),
                linear-gradient(180deg, #17141b 0%, var(--cream) 100%);
            color: var(--text);
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ---------- Frame ---------- */
        .auth-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 24px;
        }

        .auth-frame {
            width: 100%;
            max-width: 1120px;
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(0, 1.08fr);
            background: var(--paper);
            border: 1px solid var(--border-pink);
            border-radius: 28px;
            box-shadow:
                0 30px 70px rgba(0, 0, 0, .5),
                0 0 40px rgba(233, 132, 197, .08);
            overflow: hidden;
        }

        /* ---------- Brand panel ---------- */
        .auth-aside {
            position: relative;
            padding: 44px 44px 36px;
            background: linear-gradient(160deg, #241c2a 0%, #1d1822 55%, #17141b 100%);
            box-shadow: inset -1px 0 0 var(--border);
            overflow: hidden;
        }

        .auth-aside::before,
        .auth-aside::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-aside::before {
            width: 260px;
            height: 260px;
            top: -90px;
            right: -80px;
            background: rgba(233, 132, 197, .08);
        }

        .auth-aside::after {
            width: 180px;
            height: 180px;
            bottom: -60px;
            left: -50px;
            background: rgba(133, 82, 145, .16);
        }

        .auth-aside-inner {
            position: sticky;
            top: 36px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .auth-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--plum);
            font-weight: 800;
            font-size: 16px;
            line-height: 1.2;
            text-decoration: none;
        }

        .auth-brand-mark {
            flex: none;
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-2) 100%);
            box-shadow: 0 6px 16px rgba(233, 132, 197, .3);
        }

        .auth-brand small {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .3px;
        }

        .aside-eyebrow {
            display: inline-block;
            margin-bottom: 10px;
            padding: 4px 12px;
            border-radius: 999px;
            background: var(--pink);
            color: var(--purple);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .auth-aside h2 {
            margin: 0 0 10px;
            color: var(--plum);
            font-size: 30px;
            font-weight: 800;
            line-height: 1.22;
            letter-spacing: -.3px;
        }

        .auth-aside p {
            margin: 0;
            max-width: 420px;
            color: var(--label);
        }

        .aside-points {
            list-style: none;
            margin: 18px 0 0;
            padding: 0;
            display: grid;
            gap: 10px;
        }

        .aside-points li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            font-weight: 600;
            font-size: 14px;
        }

        .aside-points li span {
            flex: none;
            width: 26px;
            height: 26px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--pink);
            color: var(--purple);
            font-size: 12px;
            font-weight: 800;
        }

        .auth-illustration {
            width: 100%;
            max-width: 380px;
            margin: 4px auto 0;
        }

        .auth-illustration svg {
            display: block;
            width: 100%;
            height: auto;
        }

        .auth-aside-foot {
            margin: 0;
            color: var(--muted);
            font-size: 12.5px;
        }

        /* ---------- Form panel ---------- */
        .auth-main {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 56px 56px;
        }

        .auth-content {
            width: 100%;
            max-width: 560px;
        }

        .auth-content.is-narrow {
            max-width: 400px;
        }

        .auth-heading {
            margin-bottom: 26px;
        }

        .auth-heading h1 {
            margin: 0 0 6px;
            color: var(--plum);
            font-size: 28px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -.3px;
        }

        .auth-heading p {
            margin: 0;
            color: var(--muted);
        }

        .auth-status {
            margin-bottom: 20px;
            padding: 11px 14px;
            border-radius: 12px;
            background: var(--success-bg);
            color: var(--success) !important;
        }

        .auth-error-summary {
            margin-bottom: 20px;
            padding: 11px 14px;
            border: 1px solid rgba(255, 122, 168, .3);
            border-radius: 12px;
            background: var(--danger-bg);
            color: var(--danger);
            font-size: 14px;
            font-weight: 600;
        }

        .form-section + .form-section {
            margin-top: 26px;
            padding-top: 22px;
            border-top: 1px dashed var(--border);
        }

        .form-section-title {
            margin: 0 0 14px;
            color: var(--purple);
            font-size: 12.5px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px 18px;
        }

        .field-grid .span-2 {
            grid-column: 1 / -1;
        }

        .field + .field {
            margin-top: 16px;
        }

        .field-grid .field + .field {
            margin-top: 0;
        }

        .auth-form .field label {
            display: block;
            margin-bottom: 6px;
            color: var(--label);
            font-size: 14px;
            font-weight: 700;
        }

        .auth-form .field input:not([type="checkbox"]):not([type="hidden"]),
        .auth-form .field select,
        .auth-form .field textarea {
            display: block;
            width: 100%;
            min-height: 48px;
            margin: 0;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            background: #141117;
            color: var(--text);
            font: inherit;
            box-shadow: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .auth-form .field textarea {
            min-height: 96px;
            resize: vertical;
        }

        .auth-form .field input::placeholder,
        .auth-form .field textarea::placeholder {
            color: #7d7385;
        }

        .auth-form .field input:-webkit-autofill,
        .auth-form .field input:-webkit-autofill:hover,
        .auth-form .field input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text);
            -webkit-box-shadow: 0 0 0 1000px #141117 inset;
            caret-color: var(--text);
        }

        .auth-form .field input:not([type="checkbox"]):focus,
        .auth-form .field select:focus,
        .auth-form .field textarea:focus {
            border-color: var(--purple);
            outline: none;
            box-shadow: 0 0 0 4px var(--focus);
        }

        .auth-form .field [aria-invalid="true"] {
            border-color: var(--danger) !important;
            background: #1f1419 !important;
        }

        .auth-form .field ul {
            margin: 6px 0 0;
            padding: 0;
            list-style: none;
            color: var(--danger) !important;
            font-size: 13px;
            font-weight: 600;
        }

        .field-hint {
            margin: -2px 0 8px;
            color: var(--muted);
            font-size: 13px;
        }

        .map-box {
            width: 100%;
            height: 240px;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            background: var(--lavender);
            overflow: hidden;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 18px 0 24px;
        }

        .auth-check {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--text);
            font-size: 14px;
            cursor: pointer;
        }

        .auth-check input {
            width: 18px;
            height: 18px;
            margin: 0;
            border: 1.5px solid var(--lavender-2);
            border-radius: 6px;
            background-color: #141117;
            color: var(--purple);
            cursor: pointer;
        }

        .auth-check input:focus {
            box-shadow: 0 0 0 3px var(--focus);
        }

        .auth-link {
            color: var(--purple);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-link:hover {
            color: #f5a8d8;
            text-decoration: underline;
        }

        .auth-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 50px;
            padding: 0 22px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #d65fae 0%, var(--purple-2) 100%);
            color: #fff;
            font: inherit;
            font-size: 15.5px;
            font-weight: 800;
            letter-spacing: .2px;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(233, 132, 197, .22);
            transition: filter .15s, transform .05s, box-shadow .15s;
        }

        .auth-btn:hover {
            filter: brightness(1.05);
            box-shadow: 0 12px 26px rgba(233, 132, 197, .3);
        }

        .auth-btn:active {
            transform: translateY(1px);
        }

        .auth-btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 4px var(--focus), 0 10px 22px rgba(233, 132, 197, .22);
        }

        .auth-switch {
            margin: 22px 0 0;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 14px;
            text-align: center;
        }

        /* Fallback styling for other auth pages that still use Breeze components */
        .auth-content > form:not(.auth-form) input,
        .auth-content > form:not(.auth-form) select,
        .auth-content > form:not(.auth-form) textarea {
            border-color: var(--border);
            border-radius: 12px;
            min-height: 46px;
            background-color: #141117;
            color: var(--text);
        }

        .auth-content .text-gray-600,
        .auth-content .text-gray-700,
        .auth-content .text-gray-900 {
            color: var(--label) !important;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 960px) {
            .auth-shell {
                padding: 20px 16px;
                align-items: flex-start;
            }

            .auth-frame {
                grid-template-columns: 1fr;
                border-radius: 22px;
            }

            .auth-aside {
                padding: 26px 26px 24px;
            }

            .auth-aside-inner {
                position: static;
                gap: 16px;
            }

            .auth-aside h2 {
                font-size: 22px;
            }

            .auth-illustration,
            .aside-points,
            .auth-aside-foot {
                display: none;
            }

            .auth-main {
                padding: 34px 28px 38px;
            }
        }

        @media (max-width: 560px) {
            .auth-shell {
                padding: 0;
            }

            .auth-frame {
                border: 0;
                border-radius: 0;
                box-shadow: none;
                min-height: 100vh;
            }

            .auth-main {
                padding: 28px 20px 36px;
            }

            .auth-heading h1 {
                font-size: 24px;
            }

            .field-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="auth-shell">
        <div class="auth-frame">

            <aside class="auth-aside">
                <div class="auth-aside-inner">
                    <a href="{{ route('login') }}" class="auth-brand">
                        <span class="auth-brand-mark" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <circle cx="9" cy="12" r="5.5" stroke="#fff" stroke-width="2.2" />
                                <circle cx="15" cy="12" r="5.5" stroke="#fff" stroke-width="2.2" opacity=".75" />
                            </svg>
                        </span>
                        <span>
                            Membership Management
                            <small>Member Portal &amp; Transactions</small>
                        </span>
                    </a>

                    <div>
                        @isset($aside)
                            {{ $aside }}
                        @else
                            <span class="aside-eyebrow">Member Portal</span>
                            <h2>Your membership, all in one place</h2>
                            <p>Securely manage your account and stay up to date with your membership.</p>
                        @endisset
                    </div>

                    <div class="auth-illustration" aria-hidden="true">
                        <svg viewBox="0 0 360 270" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="authCardBand" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#e984c5" />
                                    <stop offset="1" stop-color="#b04892" />
                                </linearGradient>
                            </defs>

                            <circle cx="180" cy="138" r="112" fill="#e984c5" opacity=".06" />
                            <circle cx="62" cy="58" r="17" fill="#e984c5" opacity=".35" />
                            <circle cx="306" cy="62" r="9" fill="#a99faf" opacity=".4" />
                            <circle cx="318" cy="214" r="20" fill="#b04892" opacity=".3" />
                            <circle cx="44" cy="196" r="8" fill="#a99faf" opacity=".35" />

                            <path d="M36 246 C 110 214, 210 268, 326 236" stroke="#5a3a52" stroke-width="3" stroke-linecap="round" stroke-dasharray="2 9" />

                            <g transform="rotate(-6 180 140)">
                                <rect x="84" y="80" width="194" height="122" rx="18" fill="#262029" />
                                <rect x="84" y="80" width="194" height="122" rx="18" stroke="#4a3646" stroke-width="2" />
                                <path d="M84 98 a18 18 0 0 1 18 -18 h158 a18 18 0 0 1 18 18 v18 h-194z" fill="url(#authCardBand)" />
                                <circle cx="104" cy="98" r="4" fill="#ffffff" opacity=".8" />
                                <circle cx="117" cy="98" r="4" fill="#ffffff" opacity=".55" />
                                <circle cx="126" cy="154" r="21" fill="#33293a" />
                                <circle cx="126" cy="148" r="7.5" fill="#e984c5" />
                                <path d="M112 166 c3 -8 9 -11 14 -11 s11 3 14 11" fill="#e984c5" />
                                <rect x="160" y="138" width="92" height="9" rx="4.5" fill="#3a3140" />
                                <rect x="160" y="156" width="66" height="9" rx="4.5" fill="#352c3a" />
                                <rect x="160" y="178" width="42" height="8" rx="4" fill="#5a3a52" />
                            </g>

                            <circle cx="270" cy="194" r="25" fill="#e984c5" stroke="#1c1821" stroke-width="5" />
                            <path d="M259 194 l8 8 l14 -15" stroke="#ffffff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />

                            <path transform="translate(70 128)" d="M0 -9 L2.4 -2.4 9 0 2.4 2.4 0 9 -2.4 2.4 -9 0 -2.4 -2.4Z" fill="#e984c5" />
                            <path transform="translate(256 40) scale(.8)" d="M0 -9 L2.4 -2.4 9 0 2.4 2.4 0 9 -2.4 2.4 -9 0 -2.4 -2.4Z" fill="#c9c1ce" />
                        </svg>
                    </div>

                    <p class="auth-aside-foot">
                        &copy; {{ now()->year }} Membership Management System
                    </p>
                </div>
            </aside>

            <main class="auth-main">
                <div {{ $attributes->merge(['class' => 'auth-content']) }}>
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>
</body>

</html>
