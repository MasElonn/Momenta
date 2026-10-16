@props(['user' => Auth::user(), 'current' => null])

@php
    // $current is null inside the dashboard itself (tabs switch in place) and
    // 'availability' / 'packages' on those standalone pages, where the sidebar
    // marks that page as active and the tab buttons lead back to the dashboard.
    $isPage = filled($current);
    $dashboardUrl = route('dashboard');

    $itemClass   = 'w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg';
    $activeClass = 'bg-primary text-primary-foreground';
    $idleClass   = 'bg-primary-100 text-primary-800 hover:bg-primary-200 dark:bg-primary-500/20 dark:text-primary-400 dark:hover:bg-primary-500/30 dark:focus:bg-primary-500/30';

    // Click handler for a tab button. On a standalone page the chosen tab is
    // saved first (the dashboard's x-data uses $persist, so it reopens on that
    // tab), then we navigate there.
    $tabClick = fn (string $tab, bool $resetSection = false) =>
        ($resetSection ? "tab = '$tab', section = ''" : "tab = '$tab'")
        . ($isPage ? "; \$nextTick(() => window.location = '$dashboardUrl')" : '');

    // Alpine condition for "this tab is the active one" (never true on a standalone page).
    $tabIsActive = fn (string $tab) => $isPage ? 'false' : "tab === '$tab'";
@endphp

<aside class="sticky overflow-y-auto top-0 shadow-xl w-64 h-screen border-r border-gray-200 flex flex-col items-center py-10 px-4">
    <div class="flex flex-col items-center mb-10">
        <div class="uppercase w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-medium mb-3">
            {{ substr($user->name ?? Auth::user()->name, 0, 1) }}
        </div>
        <h2 class="mt-1 text-xl font-bold">{{ $user->name ?? Auth::user()->name }}</h2>
        <span class="text-xs text-gray-500 uppercase font-semibold mt-0.5">{{ $user->role ?? 'customer' }}</span>
    </div>

    <nav class="w-full flex flex-col justify-between h-full">
        <div class="space-y-3">
            <button @click="{{ $tabClick('overview') }}"
                    :class="{{ $tabIsActive('overview') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                    class="{{ $itemClass }}">
                <x-lucide-layout-grid class="w-5 h-5" />
                Overview
            </button>

            <button @click="{{ $tabClick('booking', true) }}"
                    :class="{{ $tabIsActive('booking') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                    class="{{ $itemClass }}">
                <x-lucide-calendar class="w-5 h-5" />
                My Booking
            </button>

            <button @click="{{ $tabClick('gallery', true) }}"
                    :class="{{ $tabIsActive('gallery') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                    class="{{ $itemClass }}">
                <x-lucide-image class="w-5 h-5" />
                My Gallery
            </button>

            {{-- These two open their own pages instead of switching a tab. --}}
            <a href="{{ route('availability.index') }}"
               class="{{ $itemClass }} {{ $current === 'availability' ? $activeClass : $idleClass }}">
                <x-lucide-calendar-check class="w-5 h-5" />
                Cek Ketersediaan
            </a>

            <a href="{{ route('packages.index') }}"
               class="{{ $itemClass }} {{ $current === 'packages' ? $activeClass : $idleClass }}">
                <x-lucide-package-2 class="w-5 h-5" />
                Daftar Paket
            </a>
            <br>

            <button @click="{{ $tabClick('account') }}"
                    :class="{{ $tabIsActive('account') }} ? '{{ $activeClass }}' : '{{ $idleClass }}'"
                    class="{{ $itemClass }}">
                <x-lucide-user class="w-5 h-5" />
                My Account
            </button>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="flex w-full py-3 px-4 items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                <x-lucide-log-out class="w-5 h-5" />
                Logout
            </button>
        </form>
    </nav>
</aside>