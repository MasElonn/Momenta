<x-auth-layout
    :title="'Create account — Momenta'"
    headline="Momenta Pilihan Terbaik untuk fotografer."
    subheadline="Daftar Untuk masuk"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Buat Akun</h1>
    <p class="mb-8 text-sm text-gray-500">Tambahkan dengan detail untuk membuat akun baru</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf

        <x-auth-input
            label="Nama Pengguna"
            name="name"
            placeholder="Nama"
            required
            autofocus
            autocomplete="name"
        />

        <x-auth-input
            label="Email address"
            name="email"
            type="email"
            icon="mail"
            placeholder="name@example.com"
            required
            autocomplete="username"
        />

        <x-auth-input
            label="Password"
            name="password"
            icon="lock"
            toggle
            placeholder="Password"
            required
            autocomplete="new-password"
        />

        <x-auth-input
            label="Confirm Password"
            name="password_confirmation"
            icon="lock"
            toggle
            placeholder="Confirm password"
            required
            autocomplete="new-password"
        />

        <label class="flex items-start gap-2 text-sm text-gray-600">
            <input
                type="checkbox"
                required
                class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#1447E6] focus:ring-[#1447E6]"
            >
            I agree to Terms &amp; Conditions
        </label>

        <x-auth-button>Create account</x-auth-button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs font-medium text-gray-400">
        <div class="h-px flex-1 bg-gray-200"></div>
        OR
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <button
        type="button"
        class="flex h-12 w-full items-center justify-center gap-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#1447E6]/40"
    >
        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <circle cx="10" cy="10" r="8.5" stroke="currentColor" stroke-width="1.3" fill="none"/>
            <path d="m6.5 6.5 7 7m0-7-7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
        Sign in with Google
    </button>

    <p class="mt-6 text-center text-sm text-gray-500">
        sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-[#1447E6] hover:underline">Sign in</a>
    </p>
</x-auth-layout>
