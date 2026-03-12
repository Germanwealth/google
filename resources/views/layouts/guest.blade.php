<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'cryptorank') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --page-bg: #09111f;
                --page-bg-2: #101c31;
                --surface: rgba(10, 19, 35, 0.82);
                --surface-strong: rgba(17, 30, 52, 0.94);
                --line: rgba(148, 163, 184, 0.14);
                --text: #edf4ff;
                --muted: #9fb0c8;
                --blue: #4ea4ff;
                --cyan: #39d0ff;
                --gold: #ffcf5a;
                --shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
            }

            body {
                min-height: 100vh;
                background:
                    radial-gradient(circle at 12% 18%, rgba(57, 208, 255, 0.14), transparent 24%),
                    radial-gradient(circle at 88% 12%, rgba(78, 164, 255, 0.18), transparent 24%),
                    radial-gradient(circle at 50% 100%, rgba(255, 207, 90, 0.08), transparent 30%),
                    linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 45%, #08101d 100%);
                color: var(--text);
            }

            .auth-shell {
                position: relative;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 32px 18px;
                overflow: hidden;
            }

            .auth-shell::before {
                content: '';
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
                background-size: 44px 44px;
                mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.75), transparent 92%);
                pointer-events: none;
            }

            .auth-card {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 1120px;
                display: grid;
                gap: 24px;
                align-items: stretch;
            }

            .auth-panel,
            .auth-form-wrap {
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 28px;
                box-shadow: var(--shadow);
                backdrop-filter: blur(18px);
            }

            .auth-panel {
                padding: 28px;
                overflow: hidden;
                position: relative;
            }

            .auth-panel::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(circle at top right, rgba(57, 208, 255, 0.16), transparent 28%),
                    linear-gradient(145deg, rgba(255, 255, 255, 0.02), transparent 55%);
                pointer-events: none;
            }

            .auth-kicker {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 8px 14px;
                border-radius: 999px;
                background: rgba(78, 164, 255, 0.12);
                border: 1px solid rgba(78, 164, 255, 0.25);
                color: #cfe7ff;
                font-size: 0.76rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                font-weight: 700;
            }

            .auth-kicker::before {
                content: '';
                width: 8px;
                height: 8px;
                border-radius: 999px;
                background: #32d583;
                box-shadow: 0 0 0 6px rgba(50, 213, 131, 0.14);
            }

            .auth-panel h1 {
                margin: 18px 0 14px;
                font-size: 2.4rem;
                line-height: 1.02;
                letter-spacing: -0.05em;
                font-weight: 800;
                max-width: 10ch;
            }

            .auth-panel p {
                color: var(--muted);
                line-height: 1.8;
                max-width: 56ch;
                margin-bottom: 22px;
            }

            .auth-points {
                display: grid;
                gap: 12px;
            }

            .auth-points div {
                padding: 14px 16px;
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.06);
                color: #dce9fa;
            }

            .auth-form-wrap {
                position: relative;
                z-index: 1;
                padding: 28px;
            }

            .auth-brand {
                margin-bottom: 18px;
            }

            .auth-brand a {
                display: inline-flex;
            }

            .auth-form-wrap .w-full.sm\:max-w-md,
            .auth-form-wrap .w-full {
                width: 100%;
                max-width: none;
            }

            .auth-form-wrap .bg-white,
            .auth-form-wrap .shadow-md {
                background: transparent !important;
                box-shadow: none !important;
            }

            .auth-form-wrap .sm\:rounded-lg {
                border-radius: 0 !important;
            }

            .auth-form-wrap label {
                color: #d8e7fb;
                font-weight: 600;
            }

            .auth-form-wrap input[type="email"],
            .auth-form-wrap input[type="password"],
            .auth-form-wrap input[type="text"] {
                width: 100%;
                border-radius: 16px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                background: rgba(255, 255, 255, 0.05);
                color: #edf4ff;
                padding: 0.9rem 1rem;
            }

            .auth-form-wrap input::placeholder {
                color: #91a4bf;
            }

            .auth-form-wrap input:focus {
                border-color: rgba(78, 164, 255, 0.42);
                box-shadow: 0 0 0 4px rgba(78, 164, 255, 0.12);
            }

            .auth-form-wrap .text-gray-600,
            .auth-form-wrap .text-gray-900 {
                color: #d8e7fb !important;
            }

            .auth-form-wrap .text-red-600 {
                color: #ffb7c0 !important;
            }

            .auth-form-wrap button[type="submit"] {
                border-radius: 14px;
                padding: 0.95rem 1.2rem;
                background: linear-gradient(135deg, var(--gold) 0%, #ffb347 100%);
                color: #08101d;
                font-weight: 800;
                border: none;
                box-shadow: 0 16px 34px rgba(255, 179, 71, 0.24);
            }

            .auth-form-wrap a {
                color: #9fd4ff;
            }

            .auth-form-wrap a:hover {
                color: #ffffff;
            }

            @media (min-width: 960px) {
                .auth-card {
                    grid-template-columns: 1.05fr 0.95fr;
                }

                .auth-panel,
                .auth-form-wrap {
                    padding: 34px;
                }

                .auth-panel h1 {
                    font-size: 3.1rem;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="auth-shell">
            <div class="auth-card">
                <div class="auth-panel">
                    <span class="auth-kicker">Secure access</span>
                    <h1>Access the cryptorank control surface.</h1>
                    <p>
                        Sign in to continue into the live dashboard experience with the same market-led brand identity,
                        polished visuals, and premium crypto plus FX presentation used across the platform.
                    </p>
                    <div class="auth-points">
                        <div>Live market context and wallet-focused workflows in one environment.</div>
                        <div>Built with the same dark-blue, cyan, and gold visual language as the homepage.</div>
                        <div>Clean, modern authentication that feels aligned with the rest of the product.</div>
                    </div>
                </div>

                <div class="auth-form-wrap">
                    <div class="auth-brand">
                        <a href="/">
                            <x-application-logo style="width: 220px; height: auto; display: block;" />
                        </a>
                    </div>

                    <div class="w-full">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
