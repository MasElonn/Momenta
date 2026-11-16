<x-auth-layout
    :title="__('Reset Password') . ' — Momenta'"
    :headline="__('Every event has its own story.')"
    :subheadline="__('Create a new password for your account.')"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">{{ __('Reset Password') }}</h1>
    <p class="mb-8 text-sm text-gray-500">{{ __('Enter your new password below.') }}</p>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <x-auth-input
            :label="__('Email Address')"
            name="email"
            type="email"
            icon="mail"
            :value="$email"
            placeholder="name@example.com"
            required
            autofocus
        />

        <x-auth-input
            :label="__('New Password')"
            name="password"
            icon="lock"
            toggle
            :placeholder="__('New password')"
            required
            autocomplete="new-password"
        />

        <x-auth-input
            :label="__('Confirm Password')"
            name="password_confirmation"
            icon="lock"
            toggle
            :placeholder="__('Confirm new password')"
            required
            autocomplete="new-password"
        />

        <x-auth-button>{{ __('Reset Password') }}</x-auth-button>
    </form>
</x-auth-layout>
