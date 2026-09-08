@props([
    'label',
    'name',
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'toggle' => false,
    'icon' => null, // 'mail' | 'lock'
])

<div>
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>

    <div class="relative">
        @if($icon === 'mail')
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2.5 5.5h15v9a1 1 0 0 1-1 1h-13a1 1 0 0 1-1-1v-9Z" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 5.5 10 11l7.5-5.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        @elseif($icon === 'lock')
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="4" y="8.5" width="12" height="8" rx="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.5 8.5V6a3.5 3.5 0 0 1 7 0v2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        @endif

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $toggle ? 'password' : $type }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' => 'h-10 w-full rounded-lg border text-sm text-gray-900 placeholder-gray-400 transition
                            focus:outline-none focus:ring-2 focus:ring-[#1447E6]/40 focus:border-[#1447E6]
                            ' . ($errors->has($name) ? 'border-red-400' : 'border-gray-300') . '
                            ' . ($icon ? 'pl-11' : 'pl-4') . '
                            ' . ($toggle ? 'pr-11' : 'pr-4')
            ]) }}
        >

        @if($toggle)
            <button
                type="button"
                onclick="togglePasswordVisibility('{{ $name }}', this)"
                aria-label="Show password"
                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600"
            >
                <svg data-eye-open class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M1.5 10S4.5 4.5 10 4.5 18.5 10 18.5 10 15.5 15.5 10 15.5 1.5 10 1.5 10Z" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="10" cy="10" r="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg data-eye-closed class="hidden h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2 2l16 16M8.4 8.5A2.25 2.25 0 0 0 11.5 11.6M6.2 6.3C3.6 7.8 1.5 10 1.5 10s3 5.5 8.5 5.5c1.5 0 2.8-.4 3.9-1M13.9 13.9C16 12.6 18.5 10 18.5 10a13 13 0 0 0-3-3.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        @endif
    </div>

    <x-auth-error :name="$name" />
</div>