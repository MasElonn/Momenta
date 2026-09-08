@props(['type' => 'submit'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'inline-flex h-10 w-full items-center justify-center rounded-lg bg-[#1447E6]
                    text-sm font-semibold text-white transition
                    hover:bg-[#1138c2]
                    focus:outline-none focus:ring-2 focus:ring-[#1447E6] focus:ring-offset-2
                    disabled:cursor-not-allowed disabled:opacity-50'
    ]) }}
>
    {{ $slot }}
</button>