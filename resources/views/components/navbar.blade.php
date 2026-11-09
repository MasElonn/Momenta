<header x-data="{ open: false }"
        @keydown.escape.window="open = false"
        class="sticky top-0 z-50 border-b border-line bg-surface">

    <nav class="mx-auto flex max-w-[1180px] items-center justify-between px-6 py-3 md:px-8"
         aria-label="Navigasi utama">

        <a href="{{ url('/') }}" class="shrink-0">
            <img src="{{ asset('images/Logo.svg') }}"
                 alt="Momenta"
                 width="100"
                 class="h-auto">
        </a>

        <div class="hidden items-center gap-7 md:flex">
            <a href="{{ url('/#beranda') }}" data-nav-link class="text-sm font-medium text-brand transition-colors hover:text-brand">
                Beranda
            </a>

            <a href="{{ url('/#cara-kerja') }}" data-nav-link class="text-sm text-ink-soft transition-colors hover:text-brand">
                Cara Kerja
            </a>

            <a href="{{ url('/#fitur') }}" data-nav-link class="text-sm text-ink-soft transition-colors hover:text-brand">
                Fitur
            </a>

            <a href="{{ url('/#fotografer') }}" data-nav-link class="text-sm text-ink-soft transition-colors hover:text-brand">
                Fotografer
            </a>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-brand-dark">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="rounded-lg border border-line px-5 py-2.5 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                    Masuk
                </a>

                <a href="{{ route('register') }}"
                   class="rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-brand-dark">
                    Daftar
                </a>
            @endauth
        </div>

        <button type="button"
                class="rounded-lg p-2 text-ink transition-colors hover:bg-brand-soft md:hidden"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="menu-mobile"
                aria-label="Buka menu">

            <svg x-show="!open" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
            <svg x-show="open" x-cloak class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    <div id="menu-mobile"
         x-show="open"
         x-cloak
         x-transition.opacity.duration.200ms
         class="border-t border-line bg-surface px-6 py-5 md:hidden">

        <div class="flex flex-col gap-4">
            <a href="{{ url('/#beranda') }}"
               @click="open = false"
               class="text-base font-medium text-brand">
                Beranda
            </a>

            <a href="{{ url('/#cara-kerja') }}"
               @click="open = false"
               class="text-base text-ink-soft hover:text-brand">
                Cara Kerja
            </a>

            <a href="{{ url('/#fitur') }}"
               @click="open = false"
               class="text-base text-ink-soft hover:text-brand">
                Fitur
            </a>

            <a href="{{ url('/#fotografer') }}"
               @click="open = false"
               class="text-base text-ink-soft hover:text-brand">
                Fotografer
            </a>

            <div class="mt-2 flex flex-col gap-2.5 border-t border-line pt-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="flex justify-center rounded-lg bg-brand px-5 py-3 text-center text-sm font-semibold text-white hover:bg-brand-dark">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="flex justify-center rounded-lg border border-line px-5 py-3 text-center text-sm font-semibold text-ink hover:border-brand hover:text-brand">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                       class="flex justify-center rounded-lg bg-brand px-5 py-3 text-center text-sm font-semibold text-white hover:bg-brand-dark">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

