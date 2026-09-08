<x-auth-layout
    :title="'Sign in — Momenta'"
    headline="Setiap acara punya ceritanya sendiri."
    subheadline="Masuk untuk akses fitur-fitur kami."
    image="{{ asset('images/wisuda2.webp') }}"
>
    <h1 class="mb-1 text-2xl font-bold text-[#1447E6]">Selamat Datang!!</h1>
    <p class="mb-5 text-sm text-gray-500">tolong masukan data akun dengan benar account.</p>

    <x-auth-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-3.5" novalidate>
        @csrf

        <x-auth-input
            label="Email address"
            name="email"
            type="email"
            icon="mail"
            placeholder="name@example.com"
            required
            autofocus
            autocomplete="username"
        />

        <x-auth-input
            label="Password"
            name="password"
            icon="lock"
            toggle
            placeholder="Password"
            required
            autocomplete="current-password"
        />

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-gray-600">
                <input
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 rounded border-gray-300 text-[#1447E6] focus:ring-[#1447E6]"
                >
                ingat untuk 30 hari
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-medium text-[#1447E6] hover:underline">
                    Lupa password?
                </a>
            @endif
        </div>

        <x-auth-button>Sign in</x-auth-button>
    </form>

    <div class="my-4 flex items-center gap-3 text-xs font-medium text-gray-400">
        <div class="h-px flex-1 bg-gray-200"></div>
        OR
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <button
        type="button"
        class="flex h-10 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#1447E6]/40"
    >
        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <circle cx="10" cy="10" r="8.5" stroke="currentColor" stroke-width="1.3" fill="none"/>
            <path d="m6.5 6.5 7 7m0-7-7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
        Sign in with Google
    </button>

    <p class="mt-4 text-center text-sm text-gray-500">
        tidak punya account?
        <a href="{{ route('register') }}" class="font-semibold text-[#1447E6] hover:underline">Sign up</a>
    </p>
</x-auth-layout>