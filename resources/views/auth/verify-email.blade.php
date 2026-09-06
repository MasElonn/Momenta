<x-auth-layout
    :title="'Verify email — Momenta'"
    headline="Setiap acara punya ceritanya sendiri."
    subheadline="Satu langkah lagi sebelum kamu mulai."
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">Verify Your Email</h1>
    <p class="mb-8 text-sm text-gray-500">
        Thanks for signing up! Before getting started, please verify your email address by
        clicking the link we just emailed to you. If you didn't receive the email, we'll
        gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <x-auth-status status="A new verification link has been sent to the email address you provided during registration." />
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-5">
        @csrf
        <x-auth-button>Resend Verification Email</x-auth-button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit" class="w-full text-center text-sm font-semibold text-[#1447E6] hover:underline">
            Log Out
        </button>
    </form>
</x-auth-layout>
