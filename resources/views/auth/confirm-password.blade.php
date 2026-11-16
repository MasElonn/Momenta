<x-auth-layout
    :title="__('Confirm Password') . ' — Momenta'"
    :headline="__('Every event has its own story.')"
    :subheadline="__('Confirm your password to continue.')"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">{{ __('Confirm Password') }}</h1>
    <p class="mb-8 text-sm text-gray-500">
        {{ __('This is a secure area. Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5" novalidate>
        @csrf

        <x-auth-input
            :label="__('Password')"
            name="password"
            icon="lock"
            toggle
            :placeholder="__('Password')"
            required
            autofocus
            autocomplete="current-password"
        />

        <x-auth-button>{{ __('Confirm Password') }}</x-auth-button>
    </form>
</x-auth-layout>
