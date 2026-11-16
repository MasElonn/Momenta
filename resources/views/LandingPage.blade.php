<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth motion-reduce:scroll-auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momenta | {{ __('School Event Photographer Booking & Gallery') }}</title>
    <meta name="description" content="{{ __('Book photographers for school events, choose packages, and store photo results in online gallery.') }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface font-sans text-ink antialiased">

<x-navbar />

<section id="beranda" class="scroll-mt-20 bg-surface py-14 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">

            <div>
                <p class="hero-in text-sm font-semibold text-brand">
                    {{ __('For school events') }}
                </p>

                <h1 class="hero-in mt-3 font-display text-4xl font-bold leading-[1.08] tracking-tight text-ink sm:text-5xl lg:text-[3.5rem]">
                    {{ __('Organize photographers, save results, share with parents.') }}
                </h1>

                <p class="hero-in mt-5 max-w-lg text-base leading-relaxed text-ink-soft md:text-lg">
                    {{ __('Committees choose dates and packages, photographers arrive on schedule, and photos go straight into the online gallery. No more sending files via WhatsApp.') }}
                </p>

                <div class="hero-in mt-8 flex flex-wrap gap-3">
                    @auth
                        <a href="#fotografer"
                           class="rounded-lg bg-brand px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-dark">
                            {{ __('Check Availability') }}
                        </a>

                        <a href="{{ url('/dashboard') }}"
                           class="rounded-lg border border-line px-6 py-3 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                            {{ __('Open Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="rounded-lg bg-brand px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-dark">
                            {{ __('Register to Book') }}
                        </a>

                        <a href="{{ route('login') }}"
                           class="rounded-lg border border-line px-6 py-3 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                            {{ __('Log in') }}
                        </a>
                    @endauth
                </div>
            </div>

            @if (file_exists(public_path('images/wisuda2.webp')))
                <div class="hero-in hero-image relative pb-3 pr-3">
                    <div class="absolute inset-0 translate-x-3 translate-y-3 rounded-xl bg-brand"></div>

                    <img src="{{ asset('images/wisuda2.webp') }}"
                         alt="Dokumentasi acara sekolah"
                         width="960"
                         height="1080"
                         class="relative aspect-[4/3] w-full rounded-xl object-cover transition-transform duration-500 hover:scale-[1.015] lg:aspect-[5/6] lg:max-h-[540px]">
                </div>
            @endif

        </div>
    </div>
</section>

<section id="cara-kerja" class="scroll-mt-20 bg-brand-soft py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        <div class="reveal max-w-xl">
            <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">
                {{ __('From booking to gallery') }}
            </h2>

            <p class="mt-3 text-ink-soft">
                {{ __('The process is the same for any event, from class meetings to graduations.') }}
            </p>
        </div>

        <ol class="reveal-stagger mt-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">1</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">{{ __('Choose photographer and package') }}</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    {{ __('Choose photographer and package. Schedule availability will be checked directly on the booking form.') }}
                </p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">2</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">{{ __('Book and pay') }}</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    {{ __('Fill in event details, submit proof of payment, and wait for photographer confirmation.') }}
                </p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">3</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">{{ __('Photographer arrives') }}</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    {{ __('Photographer covers the event according to your scheduled date, time, and location.') }}
                </p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">4</span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">{{ __('Receive photos in gallery') }}</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    {{ __('Photos are delivered to the event gallery. Download all at once, then share with students and parents.') }}
                </p>
            </li>
        </ol>
    </div>
</section>

<section id="fitur" class="scroll-mt-20 bg-surface py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        <div class="reveal max-w-xl">
            <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">
                {{ __('What committees can do on Momenta') }}
            </h2>

            <p class="mt-3 text-ink-soft">
                {{ __('From finding available photographers to receiving final photos, everything is in one place.') }}
            </p>
        </div>

        <div class="reveal mt-10 grid overflow-hidden rounded-xl border border-line lg:grid-cols-2">

            <div class="flex flex-col justify-center bg-brand p-8 text-white md:p-12">
                <p class="text-sm font-semibold text-blue-100">{{ __('Key Features') }}</p>

                <h3 class="mt-2 font-display text-2xl font-bold md:text-3xl">
                    {{ __('Schedule check during booking') }}
                </h3>

                <p class="mt-3 max-w-md leading-relaxed text-blue-100">
                    {{ __("Select photographer and package first. Then enter the event date and time to verify the photographer's availability.") }}
                </p>

                <a href="#fotografer"
                   class="mt-7 inline-flex w-fit items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-brand transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-soft">
                    {{ __('Select photographer') }}
                </a>
            </div>

            <div class="space-y-4 bg-surface p-6 md:p-10">
                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5 transition-transform duration-300 hover:translate-x-1">
                    <h3 class="font-semibold text-ink">{{ __('Online booking and payment') }}</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">
                        {{ __('Choose a package, set schedule and location, and upload payment receipt in one flow.') }}
                    </p>
                </div>

                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5 transition-transform duration-300 hover:translate-x-1">
                    <h3 class="font-semibold text-ink">{{ __('Gallery per event') }}</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">
                        {{ __('Photos from the session are grouped by event and can be downloaded all at once.') }}
                    </p>
                </div>

                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5 transition-transform duration-300 hover:translate-x-1">
                    <h3 class="font-semibold text-ink">{{ __('Booking status') }}</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">
                        {{ __('Track booking from submission until the event is finished.') }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="fotografer" class="scroll-mt-20 bg-slate-100 py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        <div class="reveal max-w-xl">
            <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">
                {{ __('Choose photographer') }}
            </h2>

            <p class="mt-3 text-ink-soft">
                {{ __('See available photographers and choose the package for your event needs.') }}
            </p>
        </div>

        @if ($fotografer->isEmpty())
            <p class="mt-8 rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-ink-soft">
                {{ __('No photographers available yet.') }}
            </p>
        @else
            <div class="reveal-stagger mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($fotografer as $item)
                    <x-fotografer-card :item="$item" />
                @endforeach
            </div>

            @if ($totalFotografer > $fotografer->count())
                <div class="mt-10 text-center">
                    <a href="{{ route('fotografer.browse') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-line bg-white px-6 py-3 text-sm font-semibold text-ink shadow-xs transition hover:border-brand hover:text-brand">
                        {{ __('See All Photographers') }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        @endif

    </div>
</section>

<section class="bg-navy">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-8 px-6 py-14 md:flex-row md:items-center md:justify-between md:px-8 md:py-16">

        <div class="reveal max-w-lg">
            <h2 class="font-display text-2xl font-bold tracking-tight text-white md:text-3xl">
                {{ __('Have a school event next month?') }}
            </h2>

            <p class="mt-3 text-blue-100">
                {{ __('Choose a photographer, set the schedule, and proceed with booking from one place.') }}
            </p>
        </div>

        <div class="reveal flex flex-wrap gap-3">
            @auth
                <a href="#fotografer"
                   class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-navy transition-colors hover:bg-brand-soft">
                    {{ __('Select photographer') }}
                </a>

                <a href="{{ url('/dashboard') }}"
                   class="rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white transition-colors hover:border-white">
                    {{ __('Open Dashboard') }}
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-navy transition-colors hover:bg-brand-soft">
                    {{ __('Register now') }}
                </a>

                <a href="{{ route('login') }}"
                   class="rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white transition-colors hover:border-white">
                    {{ __('Log in') }}
                </a>
            @endauth
        </div>
    </div>
</section>

<footer class="border-t border-line bg-page py-10">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-6 px-6 md:flex-row md:items-center md:justify-between md:px-8">

        <a href="#beranda" class="shrink-0">
            <img src="{{ asset('images/Logo.svg') }}"
                 alt="Momenta"
                 width="100"
                 class="h-auto">
        </a>

        <nav aria-label="Footer"
             class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-ink-soft">

            <a href="#beranda" class="transition-colors hover:text-ink">{{ __('Home') }}</a>
            <a href="#cara-kerja" class="transition-colors hover:text-ink">{{ __('How It Works') }}</a>
            <a href="#fitur" class="transition-colors hover:text-ink">{{ __('Features') }}</a>
            <a href="#fotografer" class="transition-colors hover:text-ink">{{ __('Photographers') }}</a>
            <a href="{{ url('/dashboard') }}" class="transition-colors hover:text-ink">{{ __('Dashboard') }}</a>
        </nav>

        <p class="text-sm text-ink-soft">
            © {{ date('Y') }} Momenta.
        </p>
    </div>
</footer>

</body>
</html>