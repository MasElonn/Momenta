@props([
    'headline' => null,
    'subheadline' => null,
    'image' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Momenta' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#1447E6]">
    <div class="flex min-h-screen w-full flex-col md:flex-row">

        {{-- Left brand / image panel --}}
        <div class="relative hidden w-full overflow-hidden bg-[#1447E6] p-8 md:flex md:w-[45%] md:flex-col md:justify-between lg:p-10">

            <a href="/" class="relative z-20 flex items-center gap-2 text-lg font-semibold text-white">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2 3 20h4.2L12 10.5 16.8 20H21L12 2Z" />
                </svg>
                Momenta
            </a>

            {{-- Diagonally clipped photo --}}
            <div class="absolute inset-0 z-0" style="clip-path: polygon(0 18%, 100% 0%, 100% 82%, 0% 100%);">
                <img
                    src="{{ $image ?? asset('images/auth-hero.jpg') }}"
                    alt=""
                    class="h-full w-full object-cover"
                >
                <div class="absolute inset-0 bg-[#1447E6]/10"></div>
            </div>

            <div class="relative z-20 max-w-md text-white">
                @if($headline)
                    <h2 class="mb-3 text-2xl font-bold leading-snug lg:text-3xl">{{ $headline }}</h2>
                @endif
                @if($subheadline)
                    <p class="text-white/85">{{ $subheadline }}</p>
                @endif
            </div>
        </div>

        {{-- Right form panel --}}
        <div class="flex w-full flex-1 items-center justify-center bg-[#FDFFFF] px-6 py-12 sm:px-10">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            button.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            button.querySelector('[data-eye-open]').classList.toggle('hidden', isHidden);
            button.querySelector('[data-eye-closed]').classList.toggle('hidden', !isHidden);
        }
    </script>
</body>
</html>
