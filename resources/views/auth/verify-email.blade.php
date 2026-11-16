<x-auth-layout
    :title="__('Verify Email') . ' — Momenta'"
    :headline="__('Every event has its own story.')"
    :subheadline="__('One more step before you get started.')"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">{{ __('Verify Your Email') }}</h1>
    <p class="mb-8 text-sm text-gray-500">
        {{ __("Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you. If you didn't receive the email, we will gladly send you another.") }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <x-auth-status :status="__('A new verification link has been sent to the email address you provided during registration.')" />
    @endif

    <form method="POST" action="{{ Route::has('verification.send') ? route('verification.send') : '#' }}" class="space-y-5">
        @csrf
        <x-auth-button>{{ __('Resend Verification Email') }}</x-auth-button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit" class="w-full text-center text-sm font-semibold text-[#1447E6] hover:underline">
            {{ __('Log Out') }}
        </button>
    </form>
</x-auth-layout>
