<x-guest-layout>
    <div style="margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.75rem; line-height: 1.1; font-weight: 800; letter-spacing: -0.03em; color: #edf4ff; margin-bottom: 0.65rem;">
            Sign in
        </h2>
        <p style="color: #9fb0c8; line-height: 1.7; margin: 0;">
            Continue to the live dashboard, review market movement, and manage your account with the updated branded interface.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6" style="gap: 1rem; flex-wrap: wrap;">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-0">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div style="margin-top: 1.25rem; color: #9fb0c8; font-size: 0.95rem;">
                Need access?
                <a href="{{ route('register') }}" style="font-weight: 700; text-decoration: none;">Create an account</a>
            </div>
        @endif
    </form>
</x-guest-layout>
