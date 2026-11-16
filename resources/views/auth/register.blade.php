
<x-auth-layout
    :title="__('Create account') . ' — Momenta'"
    :headline="__('Momenta — The best choice for photographers.')"
    :subheadline="__('Sign up to get started')"
    image="{{ asset('images/wisuda2.webp') }}"
>
    <h1 class="mb-2 text-4xl font-bold text-[#1447E6]">{{ __('Create account') }}</h1>
    <p class="mb-8 text-sm text-gray-500">
        {{ __('Add your details to create a new account') }}
    </p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
        @csrf

        <div x-data="{ selectedRole: '{{ old('role', 'customer') }}' }">
            <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-600">{{ __('Register as') }}</label>
            <div class="grid grid-cols-2 gap-3">
                <label :class="selectedRole === 'customer' ? 'border-[#1447E6] bg-[#1447E6]/5 text-[#1447E6]' : 'border-gray-200 text-gray-600 hover:border-gray-300'"
                       class="flex cursor-pointer flex-col rounded-xl border-2 p-3 transition">
                    <input type="radio" name="role" value="customer" class="sr-only" x-model="selectedRole">
                    <span class="text-sm font-bold">{{ __('Customer') }}</span>
                    <span class="mt-0.5 text-xs text-gray-500">{{ __('Book event photographers') }}</span>
                </label>

                <label :class="selectedRole === 'fotografer' ? 'border-[#1447E6] bg-[#1447E6]/5 text-[#1447E6]' : 'border-gray-200 text-gray-600 hover:border-gray-300'"
                       class="flex cursor-pointer flex-col rounded-xl border-2 p-3 transition">
                    <input type="radio" name="role" value="fotografer" class="sr-only" x-model="selectedRole">
                    <span class="text-sm font-bold">{{ __('Photographer') }}</span>
                    <span class="mt-0.5 text-xs text-gray-500">{{ __('Requires admin approval') }}</span>
                </label>
            </div>
        </div>

        <x-auth-input
            :label="__('Full Name')"
            name="name"
            placeholder="{{ __('Full Name') }}"
            required
            autofocus
            autocomplete="name"
        />

        <x-auth-input
            :label="__('Phone / WhatsApp Number')"
            name="no_hp"
            type="tel"
            placeholder="08123456789"
        />

        <x-auth-input
            :label="__('Email address')"
            name="email"
            type="email"
            icon="mail"
            placeholder="name@example.com"
            required
            autocomplete="username"
        />

        <x-auth-input
            :label="__('Password')"
            name="password"
            icon="lock"
            toggle
            placeholder="{{ __('Password') }}"
            required
            autocomplete="new-password"
        />

        <x-auth-input
            :label="__('Confirm Password')"
            name="password_confirmation"
            icon="lock"
            toggle
            placeholder="{{ __('Confirm Password') }}"
            required
            autocomplete="new-password"
        />

        <x-auth-button>{{ __('Register') }}</x-auth-button>
    </form>

    <div class="my-6 flex items-center gap-3 text-xs font-medium text-gray-400">
        <div class="h-px flex-1 bg-gray-200"></div>
        OR
        <div class="h-px flex-1 bg-gray-200"></div>
    </div>

    <p class="mt-6 text-center text-sm text-gray-500">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}"
           class="font-semibold text-[#1447E6] hover:underline">
            {{ __('Sign in') }}
        </a>
    </p>
</x-auth-layout>
