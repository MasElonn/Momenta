@props(['item'])

@php
    $fotoTerbaik = $item->pakets->firstWhere('foto')?->foto_url ?? $item->foto_karya_url;
@endphp

<article class="group flex flex-col overflow-hidden rounded-2xl border border-line bg-white shadow-xs transition-all duration-300 hover:-translate-y-1 hover:border-brand/40 hover:shadow-lg">

    <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-100">
        <img src="{{ $fotoTerbaik }}"
             alt="Karya foto {{ $item->name }}"
             loading="lazy"
             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">

        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

        <div class="absolute top-3 left-3">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/95 px-2.5 py-1 text-xs font-semibold text-ink shadow-xs backdrop-blur-xs">
                <svg class="h-3.5 w-3.5 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                    <circle cx="12" cy="13" r="3"/>
                </svg>
                Karya Terbaik
            </span>
        </div>

        @if ($item->lokasi)
            <div class="absolute bottom-3 right-3">
                <span class="inline-flex items-center gap-1 rounded-md bg-black/60 px-2 py-0.5 text-[11px] font-medium text-white backdrop-blur-xs">
                    <svg class="h-3 w-3 text-white/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 15.193 4 10a8 8 0 0 1 16 0"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $item->lokasi }}
                </span>
            </div>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-5 sm:p-6">
        <div class="flex items-center gap-3.5">
            @if ($item->avatar_url)
                <img src="{{ $item->avatar_url }}"
                     alt="{{ $item->name }}"
                     class="h-12 w-12 shrink-0 rounded-full object-cover ring-2 ring-line">
            @else
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand-soft font-display text-base font-bold text-brand ring-2 ring-line">
                    {{ strtoupper(substr($item->name, 0, 1)) }}
                </div>
            @endif

            <div class="min-w-0 flex-1">
                <h3 class="font-display text-base font-bold leading-snug text-ink truncate">
                    {{ $item->name }}
                </h3>
                <p class="text-xs text-ink-soft truncate">
                    Fotografer Momenta
                </p>
            </div>
        </div>

        <p class="mt-3 text-sm leading-relaxed text-ink-soft line-clamp-2">
            {{ $item->bio ?? 'Mendokumentasikan setiap momen penting acara sekolah dengan hasil foto yang jernih dan berkesan.' }}
        </p>

        @if ($item->pakets->isNotEmpty())
            <div class="mt-4 flex flex-wrap gap-1.5">
                @foreach ($item->pakets->take(3) as $paket)
                    <span class="inline-flex items-center rounded-md bg-page px-2.5 py-1 text-xs font-medium text-ink-soft border border-line">
                        {{ $paket->judul }}
                    </span>
                @endforeach
                @if ($item->pakets->count() > 3)
                    <span class="inline-flex items-center rounded-md bg-page px-2 py-1 text-xs font-medium text-ink-soft border border-line">
                        +{{ $item->pakets->count() - 3 }} lainnya
                    </span>
                @endif
            </div>
        @endif

        <div class="mt-auto pt-4">
            <div class="flex items-center justify-between border-t border-line pt-3.5 text-xs text-ink-soft">
                <span class="inline-flex items-center gap-1.5 font-medium">
                    <span class="h-1.5 w-1.5 rounded-full {{ $item->pakets->isNotEmpty() ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                    {{ $item->pakets->count() }} paket tersedia
                </span>

                @if ($item->pakets->isNotEmpty())
                    <span class="font-medium">
                        Mulai <span class="font-display text-sm font-bold text-ink">{{ \App\Models\Paket::formatHargaShort((float) $item->pakets->min('harga')) }}</span>
                    </span>
                @endif
            </div>

            @if ($item->pakets->isNotEmpty())
                @if (auth()->check() && auth()->user()->role !== 'customer')
                    <button type="button" disabled
                       class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-400 cursor-not-allowed" title="Hanya akun customer yang dapat melakukan booking">
                        Booking Khusus Customer
                    </button>
                @else
                    <a href="{{ route('booking.show', $item->user_id) }}"
                       class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                        Pilih Fotografer
                    </a>
                @endif
            @else
                <span class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-400 cursor-not-allowed">
                    Belum ada paket
                </span>
            @endif
        </div>
    </div>
</article>

