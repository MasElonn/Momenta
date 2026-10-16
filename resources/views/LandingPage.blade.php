<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Momenta — Galeri &amp; Booking Fotografer Acara Sekolah</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="scroll-smooth bg-page font-sans text-ink antialiased">
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

{{-- HERO --}}
<section id="beranda" class="relative overflow-hidden bg-navy">
    <div class="absolute inset-0">
        <img src="{{ asset('images/bg1.jpg') }}" alt="" class="h-full w-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-br from-navy/80 via-navy/60 to-brand-dark/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/30 to-transparent"></div>
    </div>

    <div class="relative mx-auto max-w-[1180px] px-8 pb-24 pt-40 md:pt-48">
        <div class="hero-in inline-flex items-center gap-2 rounded-full border border-surface/25 bg-surface/10 px-3 py-1.5 text-[12.5px] font-medium text-surface backdrop-blur-sm">
            <span class="h-1.5 w-1.5 rounded-full bg-brand-soft"></span>
            Untuk acara sekolah
        </div>

        <h1 class="hero-in hero-in-delay-1 mt-6 max-w-[620px] font-display text-[36px] font-bold leading-[1.12] tracking-tight text-surface md:text-[52px]">
            Atur fotografer, simpan hasilnya,
            <span class="text-brand-soft">bagikan ke orang tua.</span>
        </h1>

        <p class="hero-in hero-in-delay-1 mt-5 max-w-[480px] text-[16.5px] leading-relaxed text-surface/75">
            Panitia tinggal pilih tanggal dan paket, fotografer datang sesuai jadwal, lalu hasil fotonya langsung muncul di galeri. Nggak perlu lagi kirim-kirim file lewat WhatsApp.
        </p>

        <div class="hero-in hero-in-delay-2 mt-8 flex flex-wrap gap-3.5">
            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-[10px] bg-brand px-[22px] py-[11px] text-[14.5px] font-semibold text-surface shadow-[0_8px_20px_-8px_rgba(20,71,230,0.55)] transition hover:-translate-y-px hover:bg-brand-dark">
                Buka Dashboard
            </a>
            <a href="/login" class="inline-flex items-center justify-center gap-2 rounded-[10px] border border-surface/30 px-[22px] py-[11px] text-[14.5px] font-semibold text-surface transition hover:border-surface hover:bg-surface/10">
                Daftar Untuk Booking
            </a>
        </div>

        {{-- Quiet stat row instead of a floating card or faked photo crops —
             grounded numbers, text only, no imagery to fight the headline. --}}
        <div class="hero-in hero-in-delay-2 mt-16 flex flex-wrap items-start gap-x-12 gap-y-6 border-t border-surface/15 pt-8">
        </div>
    </div>
</section>

{{-- CARA KERJA --}}
<section id="cara-kerja" class="px-8 py-28">
    <div class="mx-auto max-w-[1180px]">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-[0.75fr_1.25fr] md:gap-16">
            <div class="reveal md:sticky md:top-28 md:self-start">
                <p class="mb-2 text-sm font-medium italic text-brand">Cara kerja</p>
                <h2 class="font-display text-[30px] font-bold tracking-tight text-navy md:text-[36px]">Dari booking sampai galeri</h2>
                <p class="mt-4 max-w-xs text-[14.5px] leading-relaxed text-ink-soft">Prosesnya sama untuk acara apa pun, dari rapat kelas sampai wisuda.</p>
            </div>

            <div class="reveal-stagger relative max-w-xl">
                <div class="absolute bottom-2 left-[15px] top-2 w-px bg-line"></div>

                <div class="lift-card relative flex gap-6 pb-14">
                    <div class="relative z-10 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-line bg-page font-mono text-[11px] text-ink-soft">01</div>
                    <div class="pt-1">
                        <h3 class="mb-2 text-[17px] font-semibold text-navy">Pilih paket &amp; jadwal</h3>
                        <p class="max-w-md text-[14.5px] leading-relaxed text-ink-soft">Tentukan tanggal, lokasi, dan paket yang paling pas buat acaramu.</p>
                    </div>
                </div>

                <div class="lift-card relative flex gap-6 pb-14">
                    <div class="relative z-10 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-line bg-page font-mono text-[11px] text-ink-soft">02</div>
                    <div class="pt-1">
                        <h3 class="mb-2 text-[17px] font-semibold text-navy">Fotografer datang</h3>
                        <p class="max-w-md text-[14.5px] leading-relaxed text-ink-soft">Datang tepat waktu, motret sepanjang acara berlangsung.</p>
                    </div>
                </div>

                <div class="lift-card relative flex gap-6">
                    <div class="relative z-10 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-line bg-page font-mono text-[11px] text-ink-soft">03</div>
                    <div class="pt-1">
                        <h3 class="mb-2 text-[17px] font-semibold text-navy">Galeri siap dibagikan</h3>
                        <p class="max-w-md text-[14.5px] leading-relaxed text-ink-soft">Foto yang sudah diedit masuk ke galeri, tinggal bagikan link-nya ke siswa dan orang tua.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section id="fitur" class="bg-page px-8 py-28">
    <div class="mx-auto max-w-[1180px]">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-[0.75fr_1.25fr] md:gap-16">
            <div class="reveal md:sticky md:top-28 md:self-start">
                <p class="mb-2 text-sm font-medium italic text-brand">Fitur</p>
                <h2 class="font-display text-[30px] font-bold tracking-tight text-navy md:text-[36px]">Yang bisa panitia lakukan di sini</h2>
            </div>

            <div class="reveal-stagger max-w-xl divide-y divide-line border-t border-line">
                <div class="lift-card flex items-start gap-5 py-7">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                    <div>
                        <h4 class="mb-1 text-[15px] font-semibold text-navy">Jadwal Sesi</h4>
                        <p class="max-w-sm text-[14px] leading-relaxed text-ink-soft">Atur tanggal dan lokasi sesi foto tanpa bentrok.</p>
                    </div>
                </div>

                <div class="lift-card flex items-start gap-5 py-7">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    </div>
                    <div>
                        <h4 class="mb-1 text-[15px] font-semibold text-navy">Galeri Online</h4>
                        <p class="max-w-sm text-[14px] leading-relaxed text-ink-soft">Hasil foto tersusun rapi per acara dan siap diunduh, tinggal bagikan satu link.</p>
                    </div>
                </div>

                <div class="lift-card flex items-start gap-5 py-7">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    </div>
                    <div>
                        <h4 class="mb-1 text-[15px] font-semibold text-navy">Fotografer Terverifikasi</h4>
                        <p class="max-w-sm text-[14px] leading-relaxed text-ink-soft">Pilih berdasarkan lokasi dan pengalaman acara sekolah.</p>
                    </div>
                </div>

                <div class="lift-card flex items-start gap-5 py-7">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                    </div>
                    <div>
                        <h4 class="mb-1 text-[15px] font-semibold text-navy">Status Booking</h4>
                        <p class="max-w-sm text-[14px] leading-relaxed text-ink-soft">Lihat progres booking, dari diajukan sampai selesai.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PAKET --}}
<section id="harga" class="border-y border-line bg-surface px-8 py-28">
    <div class="mx-auto max-w-[1180px]">
        <div class="reveal mb-14 max-w-xl">
            <p class="mb-2 text-sm font-medium italic text-brand">Harga</p>
            <h2 class="font-display text-[30px] font-bold tracking-tight text-navy md:text-[36px]">Paket yang bisa disesuaikan</h2>
        </div>

        <div class="relative" x-data="paketSlider" x-init="init()">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 z-10 w-14 bg-gradient-to-r from-surface to-transparent transition-opacity duration-300 sm:w-20"
                :class="canScrollLeft ? 'opacity-100' : 'opacity-0'"
            ></div>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 z-10 w-14 bg-gradient-to-l from-surface to-transparent transition-opacity duration-300 sm:w-20"
                :class="canScrollRight ? 'opacity-100' : 'opacity-0'"
            ></div>

            <button
                type="button"
                @click="prev()"
                aria-label="Paket sebelumnya"
                class="slider-arrow absolute left-0 top-1/2 z-20 hidden h-11 w-11 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-line bg-page text-navy shadow-lg transition hover:-translate-y-1/2 hover:border-brand hover:bg-brand hover:text-surface md:flex"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </button>

            <div
                x-ref="slider"
                @scroll="updateEdges()"
                @pointerdown="startDrag($event)"
                @pointermove="duringDrag($event)"
                @pointerup="endDrag()"
                @pointercancel="endDrag()"
                @pointerleave="pointerLeave()"
                @mouseenter="pauseAutoSlide()"
                @mouseleave="resumeAutoSlide()"
                class="package-slider reveal-stagger flex snap-x snap-mandatory items-stretch gap-8 overflow-x-auto px-1 pb-4 pt-5 cursor-grab select-none active:cursor-grabbing [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
            >
                @forelse ($pakets as $paket)
                    <div class="package-card {{ $paket->is_populer
                            ? 'lift-card-featured relative flex w-[300px] shrink-0 snap-center flex-col rounded-2xl border border-navy bg-navy p-8 text-surface shadow-[0_30px_60px_-25px_rgba(11,42,140,0.45)] sm:w-[320px]'
                            : 'lift-card relative flex w-[300px] shrink-0 snap-center flex-col rounded-2xl border border-line bg-page p-8 sm:w-[320px]' }}">

                        @if ($paket->is_populer)
                            <div class="absolute -top-[13px] left-7 rounded-full bg-brand px-3 py-1.5 text-[11.5px] font-semibold text-surface">Paling Populer</div>
                        @endif

                        <span class="mb-4 font-mono text-[11px] {{ $paket->is_populer ? 'text-brand-soft/70' : 'text-ink-soft' }}">Paket {{ sprintf('%02d', $loop->iteration) }}</span>

                        <h3 class="mb-1.5 text-lg font-semibold {{ $paket->is_populer ? '' : 'text-navy' }}">{{ $paket->judul }}</h3>
                        <p class="mb-[22px] text-[13.5px] {{ $paket->is_populer ? 'text-brand-soft/70' : 'text-ink-soft' }}">{{ $paket->deskripsi }}</p>
                        <div class="font-display text-[34px] font-bold {{ $paket->is_populer ? 'text-surface' : 'text-navy' }}">
                            {{ $paket->harga_formatted }}<span class="text-sm font-medium {{ $paket->is_populer ? 'text-brand-soft/70' : 'text-ink-soft' }}">/sesi</span>
                        </div>

                        <ul class="my-[26px] flex-grow list-none">
                            <li class="flex items-start gap-2.5 py-2 text-sm {{ $paket->is_populer ? 'text-brand-soft/90' : 'text-ink-soft' }}">
                                <svg class="mt-0.5 h-4 w-4 flex-shrink-0 {{ $paket->is_populer ? 'stroke-brand-soft' : 'stroke-brand' }}" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                                {{ $paket->durasi }} sesi foto
                            </li>
                            <li class="flex items-start gap-2.5 py-2 text-sm {{ $paket->is_populer ? 'text-brand-soft/90' : 'text-ink-soft' }}">
                                <svg class="mt-0.5 h-4 w-4 flex-shrink-0 {{ $paket->is_populer ? 'stroke-brand-soft' : 'stroke-brand' }}" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                                {{ $paket->jumlah_foto }}
                            </li>
                            <li class="flex items-start gap-2.5 py-2 text-sm {{ $paket->is_populer ? 'text-brand-soft/90' : 'text-ink-soft' }}">
                                <svg class="mt-0.5 h-4 w-4 flex-shrink-0 {{ $paket->is_populer ? 'stroke-brand-soft' : 'stroke-brand' }}" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                                {{ $paket->jumlah_fotografer }}
                            </li>
                            <li class="flex items-start gap-2.5 py-2 text-sm {{ $paket->is_populer ? 'text-brand-soft/90' : 'text-ink-soft' }}">
                                <svg class="mt-0.5 h-4 w-4 flex-shrink-0 {{ $paket->is_populer ? 'stroke-brand-soft' : 'stroke-brand' }}" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                                {{ $paket->durasi_galeri }}
                            </li>
                        </ul>

                        <a href="{{ route('booking.show', ['id' => $paket->fotografer_id, 'paket' => $paket->paket_id]) }}"
                           class="{{ $paket->is_populer
                                ? 'inline-flex w-full items-center justify-center gap-2 rounded-[10px] bg-brand px-[22px] py-[11px] text-[14.5px] font-semibold text-surface transition hover:bg-brand-dark'
                                : 'inline-flex w-full items-center justify-center gap-2 rounded-[10px] border border-line px-[22px] py-[11px] text-[14.5px] font-semibold text-navy transition hover:border-brand hover:text-brand' }}">
                            Pilih Paket
                        </a>
                    </div>
                @empty
                    <div class="w-full rounded-2xl border border-dashed border-line bg-page p-12 text-center text-sm text-ink-soft">
                        Belum ada paket yang tersedia saat ini.
                    </div>
                @endforelse
            </div>

            <button
                type="button"
                @click="next()"
                aria-label="Paket berikutnya"
                class="slider-arrow absolute right-0 top-1/2 z-20 hidden h-11 w-11 translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-line bg-page text-navy shadow-lg transition hover:-translate-y-1/2 hover:border-brand hover:bg-brand hover:text-surface md:flex"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>

            @if ($pakets->count() > 1)
                <div class="mt-5 flex items-center justify-center gap-2">
                    @foreach ($pakets as $paket)
                        <button
                            type="button"
                            @click="scrollToIndex({{ $loop->index }})"
                            aria-label="Ke paket {{ $loop->iteration }}"
                            class="h-1.5 rounded-full transition-all duration-300"
                            :class="current === {{ $loop->index }} ? 'w-6 bg-brand' : 'w-1.5 bg-line'"
                        ></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

{{-- CTA BAND --}}
<section class="px-8 py-20">
    <div class="reveal mx-auto flex max-w-[1180px] flex-col flex-wrap items-start justify-between gap-8 rounded-3xl bg-navy p-9 sm:p-12 md:flex-row md:items-center">
        <div>
            <h2 class="max-w-[420px] text-[28px] font-bold text-surface">Ada acara sekolah bulan depan?</h2>
            <p class="mt-2.5 max-w-[420px] text-[14.5px] text-brand-soft/70">Daftar, lalu langsung pilih fotografer dan tanggalnya.</p>
        </div>
        <div class="flex gap-3.5">
            <a href="#" class="inline-flex items-center justify-center gap-2 rounded-[10px] bg-brand px-[22px] py-[11px] text-[14.5px] font-semibold text-surface transition hover:bg-brand-dark">Daftar Sekarang</a>
            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-[10px] border border-brand-soft/30 px-[22px] py-[11px] text-[14.5px] font-semibold text-surface transition hover:border-brand-soft">Buka Dashboard</a>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="px-8 pb-8 pt-12">
    <div class="mx-auto flex max-w-[1180px] flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-2.5 font-display text-base font-bold text-navy">
            <img src="{{ asset('images/Logo.svg') }}" alt="Logo" width="100">
        </div>
        <div class="flex flex-row items-center gap-5">
            <a class="nav-link text-sm font-medium text-brand focus:outline-hidden" href="#beranda" data-nav-link aria-current="page">Beranda</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#cara-kerja" data-nav-link>Cara Kerja</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#fitur" data-nav-link>Fitur</a>
            <a class="nav-link text-sm text-ink-soft hover:text-navy focus:outline-hidden" href="#harga" data-nav-link>Paket</a>
        </div>
        <div class="text-[13px] text-ink-soft">© 2026 Momenta.</div>
    </div>
</footer>

</body>
</html>