<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Package List') }} — Momenta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-sans text-ink antialiased min-h-screen">
    <x-navbar />

    <main class="mx-auto max-w-6xl px-6 py-10 md:px-8">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="font-display text-[26px] font-bold tracking-tight text-navy sm:text-[30px]">
                    {{ __('Package List') }}
                </h1>
                <p class="mt-2 text-[14.5px] leading-relaxed text-ink-soft">
                    {{ __('All packages from our photographers. Choose the package that suits your event needs.') }}
                </p>
            </div>
        </div>

        @if ($pakets->isEmpty())
            <div class="flex flex-col items-center gap-3 rounded-2xl border-2 border-dashed border-line bg-surface px-6 py-16 text-center">
                <p class="font-semibold text-navy">{{ __('No packages available yet') }}</p>
                <p class="text-sm text-ink-soft">
                    {{ __("Photographers haven't added packages yet. Please check back later.") }}
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($pakets as $paket)
                    <div class="flex flex-col rounded-2xl border border-line bg-surface p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-brand/40 hover:shadow-lg">
                        @if ($paket->foto)
                            <div class="mb-4 aspect-[16/10] w-full overflow-hidden rounded-xl bg-slate-100">
                                <img src="{{ $paket->foto_url }}" alt="{{ $paket->judul }}" class="h-full w-full object-cover">
                            </div>
                        @endif

                        <div class="mb-3 flex items-start justify-between gap-3">
                            <h3 class="text-[17px] font-semibold text-navy">
                                {{ $paket->judul }}
                            </h3>

                            @if (! $paket->tersedia)
                                <span class="shrink-0 rounded-full bg-slate-200 px-2.5 py-1 text-[11px] font-semibold text-slate-700">
                                    {{ __('Unavailable') }}
                                </span>
                            @elseif ($paket->is_populer)
                                <span class="shrink-0 rounded-full bg-brand-soft px-2.5 py-1 text-[11px] font-semibold text-brand">
                                    {{ __('Popular') }}
                                </span>
                            @endif
                        </div>

                        <p class="mb-4 line-clamp-2 text-[13.5px] text-ink-soft">
                            {{ $paket->deskripsi }}
                        </p>

                        <div class="mb-4 font-display text-[28px] font-bold text-navy">
                            {{ $paket->harga_formatted }}
                            <span class="text-sm font-medium text-ink-soft">/{{ __('session') }}</span>
                        </div>

                        <ul class="mb-5 space-y-2 text-sm text-ink-soft">
                            <li class="flex items-start gap-2.5">
                                <span class="text-brand">✓</span>
                                {{ $paket->durasi }} {{ __('photo session') }}
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-brand">✓</span>
                                {{ $paket->jumlah_foto }}
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-brand">✓</span>
                                {{ $paket->jumlah_fotografer }}
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-brand">✓</span>
                                {{ $paket->durasi_galeri }}
                            </li>
                        </ul>

                        <p class="mb-5 flex items-center gap-1.5 border-t border-line pt-4 text-xs text-ink-soft">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            {{ $paket->fotografer->name ?? '-' }}
                        </p>

                        @if ($paket->tersedia)
                            @if (auth()->check() && auth()->user()->role !== 'customer')
                                <button type="button" disabled
                                       class="mt-auto inline-flex cursor-not-allowed items-center justify-center rounded-[10px] bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-400" aria-disabled="true" title="{{ __('Customer account only') }}">
                                    {{ __('Customer Account Only') }}
                                </button>
                            @else
                                <a href="{{ route('booking.show', ['id' => $paket->fotografer_id, 'paket' => $paket->paket_id]) }}"
                                   class="mt-auto inline-flex items-center justify-center rounded-[10px] bg-brand px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark">
                                    {{ __('Select Package') }}
                                </a>
                            @endif
                        @else
                            <span class="mt-auto inline-flex cursor-not-allowed items-center justify-center rounded-[10px] bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500" aria-disabled="true">
                                {{ __('Unavailable') }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
