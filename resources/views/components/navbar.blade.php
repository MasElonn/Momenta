<link rel="shortcut icon" type="image/x-icon" href="{{asset("favicon.ico")}}">
<div>

<header class="sticky top-0 z-50 border-b border-line bg-page/85 backdrop-blur">
    <nav class="mx-auto flex w-full max-w-[1180px] flex-wrap items-center justify-between gap-4 px-8 py-[14px] sm:flex-nowrap">
        <div>
            <img src="{{ asset('images/Logo.svg') }}" alt="Logo" width="100">
        </div>

        <div class="flex flex-row items-center gap-5">
            <a class="nav-link text-sm font-medium text-brand focus:outline-hidden" href="#beranda" data-nav-link aria-current="page">Beranda</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#cara-kerja" data-nav-link>Cara Kerja</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#fitur" data-nav-link>Fitur</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#harga" data-nav-link>Paket</a>
        </div>

        <div class="inline-flex flex-wrap gap-2">
            <a href="/dashboard" class="inline-flex items-center gap-x-1 rounded-lg border border-line px-6 py-1.5 text-sm font-medium text-navy transition hover:border-brand hover:text-brand focus:outline-hidden disabled:pointer-events-none disabled:opacity-50">
                Dashboard
            </a>
            <a href="/login" class="inline-flex items-center gap-x-2 rounded-lg border border-brand bg-brand px-6 py-1.5 text-sm font-normal text-surface transition hover:bg-brand-dark focus:outline-hidden disabled:pointer-events-none disabled:opacity-50">
                Sign Up
            </a>
        </div>
    </nav>
</header>
</div>
