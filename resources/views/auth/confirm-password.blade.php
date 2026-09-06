<x-auth-layout
    :title="'Confirm password — Momenta'"
    headline="Setiap acara punya ceritanya sendiri."
    subheadline="Konfirmasi kata sandi untuk melanjutkan."
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Confirm Password</h1>
    <p class="mb-8 text-sm text-gray-500">
        This is a secure area. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5" novalidate>
        @csrf

        <x-auth-input
            label="Password"
            name="password"
            icon="lock"
            toggle
            placeholder="Password"
            required
            autofocus
            autocomplete="current-password"
        />

        <x-auth-button>Confirm Password</x-auth-button>
    </form>
</x-auth-layout>
