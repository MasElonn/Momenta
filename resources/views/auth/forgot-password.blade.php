<x-auth-layout
    :title="__('Forgot Password') . ' — Momenta'"
    :headline="__('Every event has its own story.')"
    :subheadline="__('We will help you get back in.')"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">{{ __('Forgot Password?') }}</h1>
    <p class="mb-8 text-sm text-gray-500">
        {{ __("No worries, enter your email and we'll send you a reset link.") }}
    </p>

    <x-auth-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
        @csrf

        <x-auth-input
            :label="__('Email Address')"
            name="email"
            type="email"
            icon="mail"
            placeholder="name@example.com"
            required
            autofocus
        />

        <x-auth-button>{{ __('Send Password Reset Link') }}</x-auth-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
        {{ __('Remembered your password?') }}
        <a href="{{ route('login') }}" class="font-semibold text-[#1447E6] hover:underline">{{ __('Back to login') }}</a>
    </p>
</x-auth-layout>
