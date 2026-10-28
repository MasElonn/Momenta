@props(['user' => Auth::user(), 'current' => null])

@php
    $isPage = filled($current);
    $dashboardUrl = route('dashboard');

    $itemClass = 'w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg';
    $activeClass = 'bg-primary text-primary-foreground';
    $idleClass = 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30';

    $tabClick = fn (string $tab, bool $resetSection = false) =>
        ($resetSection ? "tab = '$tab', section = ''" : "tab = '$tab'")
        . ($isPage ? "; \$nextTick(() => window.location = '$dashboardUrl')" : '');

    $tabIsActive = fn (string $tab) => $isPage ? 'false' : "tab === '$tab'";
@endphp

<aside class="sticky top-0 flex h-screen w-64 flex-col items-center overflow-y-auto border-r border-gray-200 px-4 py-10 shadow-xl">

    {{-- PROFILE --}}
    <div class="mb-10 flex flex-col items-center">
        <div class="mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-primary text-2xl font-medium uppercase text-white">
            {{ substr($user->name ?? Auth::user()->name, 0, 1) }}
        </div>

        <h2 class="mt-1 text-xl font-bold">
            {{ $user->name ?? Auth::user()->name }}
        </h2>

        <span class="mt-0.5 text-xs font-semibold uppercase text-gray-500">
            {{ $user->role ?? 'customer' }}
        </span>
    </div>

    {{-- NAVIGATION --}}
    <nav class="flex h-full w-full flex-col justify-between">

        <div class="space-y-3">

            {{-- OVERVIEW --}}
            <button
                type="button"
                @click="{{ $tabClick('overview') }}"
                :class="{{ $tabIsActive('overview') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                class="{{ $itemClass }}"
            >
                <x-lucide-layout-grid class="h-5 w-5" />
                Overview
            </button>

            {{-- MY BOOKING --}}
            <button
                type="button"
                @click="{{ $tabClick('booking', true) }}"
                :class="{{ $tabIsActive('booking') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                class="{{ $itemClass }}"
            >
                <x-lucide-calendar class="h-5 w-5" />
                My Booking
            </button>

            {{-- MY GALLERY --}}
            <button
                type="button"
                @click="{{ $tabClick('gallery', true) }}"
                :class="{{ $tabIsActive('gallery') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                class="{{ $itemClass }}"
            >
                <x-lucide-image class="h-5 w-5" />
                My Gallery
            </button>

            {{-- CEK KETERSEDIAAN --}}
            <a
                href="{{ route('availability.index') }}"
                class="{{ $itemClass }} {{ $current === 'availability' ? $activeClass : $idleClass }}"
            >
                <x-lucide-calendar-check class="h-5 w-5" />
                Cek Ketersediaan
            </a>

            {{-- DAFTAR PAKET --}}
            <a
                href="{{ route('packages.index') }}"
                class="{{ $itemClass }} {{ $current === 'packages' ? $activeClass : $idleClass }}"
            >
                <x-lucide-package-2 class="h-5 w-5" />
                Daftar Paket
            </a>

            {{-- MY ACCOUNT --}}
            <button
                type="button"
                @click="{{ $tabClick('account') }}"
                :class="{{ $tabIsActive('account') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                class="{{ $itemClass }}"
            >
                <x-lucide-user class="h-5 w-5" />
                My Account
            </button>

        </div>

        {{-- LOGOUT --}}
        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            class="mt-8 w-full"
        >
            @csrf

            <button
                type="button"
                @click="
                    Swal.fire({
                        title: 'Yakin ingin keluar?',
                        text: 'Kamu perlu login kembali untuk masuk ke akunmu.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, keluar',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#1447E6',
                        cancelButtonColor: '#6B7280',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $el.closest('form').submit();
                        }
                    })
                "
                class="flex w-full items-center gap-2 rounded-lg border border-red-500 px-4 py-3 text-sm font-medium text-red-500 transition hover:border-red-400 hover:text-red-400 focus:outline-hidden"
            >
                <x-lucide-log-out class="h-5 w-5" />
                Logout
            </button>
        </form>

    </nav>
</aside>