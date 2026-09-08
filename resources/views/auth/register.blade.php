<x-auth-layout
    :title="'Create account — Momenta'"
    headline="Momenta Pilihan Terbaik untuk fotografer."
    subheadline="Daftar Untuk masuk"
    image="{{ asset('images/wisuda2.webp') }}"
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
            setuju
        </label>

        <x-auth-button>Tambahkan Akun</x-auth-button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs font-medium text-gray-400">
        <div class="h-px flex-1 bg-gray-200"></div>
        OR
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <p class="mt-6 text-center text-sm text-gray-500">
        sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold text-[#1447E6] hover:underline">Sign in</a>
    </p>
</x-auth-layout>
