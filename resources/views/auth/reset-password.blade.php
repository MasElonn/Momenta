<x-auth-layout
    :title="'Reset password — Momenta'"
    headline="Setiap acara punya ceritanya sendiri."
    subheadline="Buat kata sandi baru untuk akunmu."
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Reset Password</h1>
    <p class="mb-8 text-sm text-gray-500">Enter your new password below.</p>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <x-auth-input
            label="Email address"
            name="email"
            type="email"
            icon="mail"
            :value="$email"
            placeholder="name@example.com"
            required
            autofocus
        />

        <x-auth-input
            label="New Password"
            name="password"
            icon="lock"
            toggle
            placeholder="New password"
            required
            autocomplete="new-password"
        />

        <x-auth-input
            label="Confirm Password"
            name="password_confirmation"
            icon="lock"
            toggle
            placeholder="Confirm new password"
            required
            autocomplete="new-password"
        />

        <x-auth-button>Reset Password</x-auth-button>
    </form>
</x-auth-layout>
