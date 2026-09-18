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
<header id="beranda" class="px-8 pb-[60px] pt-[88px]">
    <div class="mx-auto grid max-w-[1180px] grid-cols-1 items-center gap-14 md:grid-cols-[1.05fr_0.95fr]">
        <div>
            <div class="hero-in mb-5 inline-flex items-center gap-2 rounded-full bg-accent-soft px-3 py-1.5 text-[12.5px] font-semibold tracking-wide text-accent before:h-1.5 before:w-1.5 before:rounded-full before:bg-accent">
                Untuk acara sekolah
            </div>

            <h1 class="hero-in hero-in-delay-1 font-display text-[34px] font-bold leading-[1.12] tracking-tight text-navy md:text-[46px]">
                Atur fotografer,<br>simpan hasilnya,<br>
                <span class="text-brand">bagikan ke orang tua.</span>
            </h1>

            <p class="hero-in hero-in-delay-1 mt-5 max-w-[480px] text-[16.5px] leading-relaxed text-ink-soft">
                Panitia tinggal pilih tanggal dan paket, fotografer datang sesuai jadwal, lalu hasil fotonya langsung muncul di galeri. Nggak perlu lagi kirim-kirim file lewat WhatsApp.
            </p>

            <div class="hero-in hero-in-delay-2 mt-8 flex flex-wrap gap-3.5">
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-[10px] bg-brand px-[22px] py-[11px] text-[14.5px] font-semibold text-surface shadow-[0_8px_20px_-8px_rgba(20,71,230,0.55)] transition hover:-translate-y-px hover:bg-brand-dark">
                    Buka Dashboard
                </a>
                <a href="/login" class="inline-flex items-center justify-center gap-2 rounded-[10px] border border-line px-[22px] py-[11px] text-[14.5px] font-semibold text-navy transition hover:border-brand hover:text-brand">
                    Daftar Untuk Booking
                </a>
            </div>
        </div>

        {{-- Signature: booking ticket card --}}
        <div class="hero-in hero-in-delay-2 float-card overflow-hidden rounded-2xl border border-line bg-surface shadow-[0_30px_60px_-30px_rgba(11,42,140,0.3)]">
            <div class="flex items-start justify-between px-6 pb-5 pt-[22px]">
                <div class="text-xs text-ink-soft">
                    Booking ID
                    <b class="mt-0.5 block font-mono text-[13.5px] text-navy">#MMT-2026-9042</b>
                </div>
                <span class="pulse-badge rounded-full bg-accent-soft px-2.5 py-1.5 text-[11.5px] font-semibold text-accent">Terjadwal</span>
            </div>

            <div class="px-6 pb-[22px]">
                <div class="flex items-start gap-3 py-3">
                    <div class="flex h-[34px] w-[34px] flex-shrink-0 items-center justify-center rounded-[9px] bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </div>
                    <div>
                        <div class="text-[11.5px] uppercase tracking-wide text-ink-soft">Tanggal Sesi</div>
                        <div class="mt-0.5 text-[14.5px] font-semibold text-navy">Kamis, 12 Nov 2026</div>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-t border-dashed border-line py-3">
                    <div class="flex h-[34px] w-[34px] flex-shrink-0 items-center justify-center rounded-[9px] bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    </div>
                    <div>
                        <div class="text-[11.5px] uppercase tracking-wide text-ink-soft">Lokasi</div>
                        <div class="mt-0.5 text-[14.5px] font-semibold text-navy">Aula Sekolah, Gerbang Utama</div>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-t border-dashed border-line py-3">
                    <div class="flex h-[34px] w-[34px] flex-shrink-0 items-center justify-center rounded-[9px] bg-brand-soft">
                        <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
                    </div>
                    <div>
                        <div class="text-[11.5px] uppercase tracking-wide text-ink-soft">Fotografer</div>
                        <div class="mt-0.5 text-[14.5px] font-semibold text-navy">Muhammad Atif</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between bg-navy px-6 py-5">
                <div>
                    <div class="text-[11.5px] text-brand-soft/80">Paket Dipilih</div>
                    <div class="mt-0.5 font-display text-xl font-bold text-surface">Rp 750.000</div>
                </div>
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-[10px] bg-brand px-4 py-2.5 text-[13px] font-semibold text-surface transition hover:bg-brand-dark">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
</header>

{{-- CARA KERJA --}}
<section id="cara-kerja" class="px-8 py-20">
    <div class="mx-auto max-w-[1180px]">
        <div class="reveal mx-auto mb-12 max-w-[600px] text-center">
            <div class="mb-3 text-[12.5px] font-semibold uppercase tracking-wider text-brand">Cara Kerja</div>
            <h2 class="font-display text-[32px] font-bold tracking-tight text-navy">Dari booking sampai galeri</h2>
            <p class="mt-3.5 text-[15.5px] leading-relaxed text-ink-soft">Prosesnya sama untuk acara apa pun, dari rapat kelas sampai wisuda.</p>
        </div>

        <div class="reveal-stagger grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="lift-card rounded-2xl border border-line bg-surface p-7">
                <div class="mb-[18px] flex h-9 w-9 items-center justify-center rounded-[10px] bg-brand-soft font-mono text-[13px] font-semibold text-brand">01</div>
                <h3 class="mb-2 text-[17px] font-semibold text-navy">Pilih paket &amp; jadwal</h3>
                <p class="text-[14.5px] leading-relaxed text-ink-soft">Tentukan tanggal, lokasi, dan paket yang paling pas buat acaramu.</p>
            </div>
            <div class="lift-card rounded-2xl border border-line bg-surface p-7">
                <div class="mb-[18px] flex h-9 w-9 items-center justify-center rounded-[10px] bg-brand-soft font-mono text-[13px] font-semibold text-brand">02</div>
                <h3 class="mb-2 text-[17px] font-semibold text-navy">Fotografer datang</h3>
                <p class="text-[14.5px] leading-relaxed text-ink-soft">Datang tepat waktu, motret sepanjang acara berlangsung.</p>
            </div>
            <div class="lift-card rounded-2xl border border-line bg-surface p-7">
                <div class="mb-[18px] flex h-9 w-9 items-center justify-center rounded-[10px] bg-brand-soft font-mono text-[13px] font-semibold text-brand">03</div>
                <h3 class="mb-2 text-[17px] font-semibold text-navy">Galeri siap dibagikan</h3>
                <p class="text-[14.5px] leading-relaxed text-ink-soft">Foto yang sudah diedit masuk ke galeri, tinggal bagikan link-nya ke siswa dan orang tua.</p>
            </div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section id="fitur" class="px-8 py-20">
    <div class="mx-auto max-w-[1180px]">
        <div class="reveal mx-auto mb-12 max-w-[600px] text-center">
            <div class="mb-3 text-[12.5px] font-semibold uppercase tracking-wider text-brand">Fitur</div>
            <h2 class="font-display text-[32px] font-bold tracking-tight text-navy">Yang bisa panitia lakukan di sini</h2>
        </div>

        <div class="reveal-stagger grid grid-cols-2 gap-5 md:grid-cols-4">
            <div class="lift-card rounded-[14px] border border-line bg-surface p-[22px]">
                <div class="mb-3.5 flex h-[34px] w-[34px] items-center justify-center rounded-[9px] bg-brand-soft">
                    <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                </div>
                <h4 class="mb-1.5 text-[14.5px] font-semibold text-navy">Jadwal Sesi</h4>
                <p class="text-[13px] leading-relaxed text-ink-soft">Atur tanggal dan lokasi sesi foto tanpa bentrok.</p>
            </div>
            <div class="lift-card rounded-[14px] border border-line bg-surface p-[22px]">
                <div class="mb-3.5 flex h-[34px] w-[34px] items-center justify-center rounded-[9px] bg-brand-soft">
                    <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                </div>
                <h4 class="mb-1.5 text-[14.5px] font-semibold text-navy">Galeri Online</h4>
                <p class="text-[13px] leading-relaxed text-ink-soft">Hasil foto tersusun rapi per acara dan siap diunduh.</p>
            </div>
            <div class="lift-card rounded-[14px] border border-line bg-surface p-[22px]">
                <div class="mb-3.5 flex h-[34px] w-[34px] items-center justify-center rounded-[9px] bg-brand-soft">
                    <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                </div>
                <h4 class="mb-1.5 text-[14.5px] font-semibold text-navy">Fotografer Terverifikasi</h4>
                <p class="text-[13px] leading-relaxed text-ink-soft">Pilih fotografer berdasarkan lokasi dan pengalaman acara sekolah.</p>
            </div>
            <div class="lift-card rounded-[14px] border border-line bg-surface p-[22px]">
                <div class="mb-3.5 flex h-[34px] w-[34px] items-center justify-center rounded-[9px] bg-brand-soft">
                    <svg class="h-4 w-4 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                </div>
                <h4 class="mb-1.5 text-[14.5px] font-semibold text-navy">Status Booking</h4>
                <p class="text-[13px] leading-relaxed text-ink-soft">Lihat progres booking, dari diajukan sampai selesai.</p>
            </div>
        </div>
    </div>
</section>

{{-- Paket --}}
<section id="harga" class="border-y border-line bg-surface px-8 py-20">
    <div class="mx-auto max-w-[1180px]">
        <div class="reveal mx-auto mb-12 max-w-[600px] text-center">
            <div class="mb-3 text-[12.5px] font-semibold uppercase tracking-wider text-brand">Harga</div>
            <h2 class="font-display text-[32px] font-bold tracking-tight text-navy">Paket yang bisa disesuaikan</h2>
            <p class="mt-3.5 text-[15.5px] leading-relaxed text-ink-soft">Contoh paket di bawah masih bisa kamu ubah nama, isi, dan harganya sesuai kebutuhan.</p>
        </div>

        <div class="reveal-stagger grid grid-cols-1 items-stretch gap-6 md:grid-cols-3">
            {{-- Paket Dasar --}}
            <div class="lift-card flex flex-col rounded-2xl border border-line bg-page p-8">
                <h3 class="mb-1.5 text-lg font-semibold">Paket Dasar</h3>
                <p class="mb-[22px] text-[13.5px] text-ink-soft">Untuk acara kelas kecil</p>
                <div class="font-display text-[34px] font-bold text-navy">Rp 500rb<span class="text-sm font-medium text-ink-soft">/sesi</span></div>
                <ul class="my-[26px] flex-grow list-none">
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        60 menit sesi foto
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        15 foto hasil edit
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        1 fotografer
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        Galeri online 30 hari
                    </li>
                </ul>
                <a href="/dashboard" class="inline-flex w-full items-center justify-center gap-2 rounded-[10px] border border-line px-[22px] py-[11px] text-[14.5px] font-semibold text-navy transition hover:border-brand hover:text-brand">Pilih Paket</a>
            </div>

            {{-- Paket Populer (featured) --}}
            <div class="lift-card-featured relative flex scale-[1.03] flex-col rounded-2xl border border-navy bg-navy p-8 text-surface shadow-[0_30px_60px_-25px_rgba(11,42,140,0.45)]">
                <div class="absolute -top-[13px] left-7 rounded-full bg-brand px-3 py-1.5 text-[11.5px] font-semibold text-surface">Paling Populer</div>
                <h3 class="mb-1.5 text-lg font-semibold">Paket Populer</h3>
                <p class="mb-[22px] text-[13.5px] text-brand-soft/70">Untuk wisuda &amp; perpisahan</p>
                <div class="font-display text-[34px] font-bold text-surface">Rp 750rb<span class="text-sm font-medium text-brand-soft/70">/sesi</span></div>
                <ul class="my-[26px] flex-grow list-none">
                    <li class="flex items-start gap-2.5 py-2 text-sm text-brand-soft/90">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand-soft" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        90 menit sesi foto
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-brand-soft/90">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand-soft" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        25 foto hasil edit
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-brand-soft/90">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand-soft" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        1 fotografer + asisten
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-brand-soft/90">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand-soft" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        Galeri online 90 hari
                    </li>
                </ul>
                <a href="#" class="inline-flex w-full items-center justify-center gap-2 rounded-[10px] bg-brand px-[22px] py-[11px] text-[14.5px] font-semibold text-surface transition hover:bg-brand-dark">Pilih Paket</a>
            </div>

            {{-- Paket Premium --}}
            <div class="lift-card flex flex-col rounded-2xl border border-line bg-page p-8">
                <h3 class="mb-1.5 text-lg font-semibold">Paket Premium</h3>
                <p class="mb-[22px] text-[13.5px] text-ink-soft">Untuk acara besar sekolah</p>
                <div class="font-display text-[34px] font-bold text-navy">Rp 1.2jt<span class="text-sm font-medium text-ink-soft">/sesi</span></div>
                <ul class="my-[26px] flex-grow list-none">
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        3 jam sesi foto
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        60 foto hasil edit
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        2 fotografer
                    </li>
                    <li class="flex items-start gap-2.5 py-2 text-sm text-ink-soft">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                        Galeri online tanpa batas
                    </li>
                </ul>
                <a href="/dashboard" class="inline-flex w-full items-center justify-center gap-2 rounded-[10px] border border-line px-[22px] py-[11px] text-[14.5px] font-semibold text-navy transition hover:border-brand hover:text-brand">Pilih Paket</a>
            </div>
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