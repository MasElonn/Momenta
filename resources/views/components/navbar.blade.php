<link rel="shortcut icon" type="image/x-icon" href="{{asset("favicon.ico")}}">
<div>

<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full py-2 bg-navbar border-b border-navbar-line">
    <nav class="max-w-340 w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between">
        <div class="">
            <img src="{{ asset("images/Logo.svg") }}" alt="Logo" width="100"  >
        </div>
                <div class="flex flex-row items-center gap-5">
            <a class="nav-link text-sm font-medium text-brand focus:outline-hidden" href="#beranda" data-nav-link aria-current="page">Beranda</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#cara-kerja" data-nav-link>Cara Kerja</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#fitur" data-nav-link>Fitur</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#harga" data-nav-link>Paket</a>
        </div>

        <div class="inline-flex flex-wrap gap-2 ">
            <a href="{{route('login')}}" type="button" class="py-1 px-6 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-layer-line text-muted-foreground-1 hover:border-primary-hover hover:text-primary-hover focus:outline-hidden focus:border-primary-focus focus:text-primary-focus  disabled:opacity-50 disabled:pointer-events-none" >
                Dashboard
            </a>
            <a href="{{route('register')}}" type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-sm font-normal rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus  disabled:opacity-50 disabled:pointer-events-none" >
                Sign Up
            </a>
        </div>
    </nav>
</header>
</div>
    