<x-auth-layout
    :title="'Forgot password — Momenta'"
    headline="Setiap acara punya ceritanya sendiri."
    subheadline="Kami akan bantu kamu masuk kembali."
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Forgot Password?</h1>
    <p class="mb-8 text-sm text-gray-500">
        No worries, enter your email and we'll send you a reset link.
    </p>

    <x-auth-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
        @csrf

        <x-auth-input
            label="Email address"
            name="email"
            type="email"
            icon="mail"
            placeholder="name@example.com"
            required
            autofocus
        />

        <x-auth-button>Send Password Reset Link</x-auth-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        Remembered your password?
        <a href="{{ route('login') }}" class="font-semibold text-[#1447E6] hover:underline">Back to login</a>
    </p>
</x-auth-layout>
