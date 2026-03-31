<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }}</title>

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
                max-width: 500px;
                display: grid;
                gap: 24px;
                align-items: stretch;
            }

            .auth-form-wrap {
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: 28px;
                box-shadow: var(--shadow);
                backdrop-filter: blur(18px);
            }

            .auth-form-wrap {
                position: relative;
                z-index: 1;
                padding: 28px;
            }

            .auth-brand {
                display: none;
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
                .auth-form-wrap {
                    padding: 34px;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="auth-shell">
            <div class="auth-card">
                <div class="auth-form-wrap">
                    <div class="w-full">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
