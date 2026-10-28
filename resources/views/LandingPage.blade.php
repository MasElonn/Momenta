<!DOCTYPE html>
<html lang="id" class="scroll-smooth motion-reduce:scroll-auto">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Momenta — Galeri &amp; Booking Fotografer Acara Sekolah</title>
<meta name="description" content="Booking fotografer untuk acara sekolah, pilih paket, dan simpan hasil foto di galeri online.">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    /* 1. Sembunyikan elemen x-cloak (menu mobile) sampai Alpine.js siap. */
    [x-cloak] { display: none !important; }

    /* 2. Garis fokus untuk pengguna keyboard (tombol Tab). */
    a:focus-visible, button:focus-visible, [tabindex="0"]:focus-visible {
        outline: 2px solid currentColor;
        outline-offset: 2px;
    }

    /* 3. Matikan animasi untuk pengguna yang memilih "reduce motion" di sistemnya. */
    @media (prefers-reduced-motion: reduce) {
        .reveal, .hero-in {
            opacity: 1 !important;
            transform: none !important;
            animation: none !important;
            transition: none !important;
        }
    }
</style>
</head>
<body class="bg-surface font-sans text-ink antialiased">

{{-- ============================================================
     NAVBAR — putih, teks gelap, aksen biru
     x-data="{ open: false }" = "open" menyimpan status menu mobile (buka/tutup)
     ============================================================ --}}
<header x-data="{ open: false }" @keydown.escape.window="open = false"
        class="sticky top-0 z-50 border-b border-line bg-surface">
    <nav class="mx-auto flex max-w-[1180px] items-center justify-between px-6 py-3 md:px-8" aria-label="Navigasi utama">

        <a href="#beranda" class="shrink-0">
            <img src="{{ asset('images/Logo.svg') }}" alt="Momenta" width="100" class="h-auto">
        </a>

        {{-- Menu desktop. data-nav-link dipakai app.js untuk menyorot menu sesuai posisi scroll. --}}
        <div class="hidden items-center gap-7 md:flex">
            <a href="#beranda" data-nav-link aria-current="page" class="nav-link text-sm font-medium text-brand transition-colors">Beranda</a>
            <a href="#cara-kerja" data-nav-link class="nav-link text-sm text-ink-soft transition-colors hover:text-ink">Cara Kerja</a>
            <a href="#fitur" data-nav-link class="nav-link text-sm text-ink-soft transition-colors hover:text-ink">Fitur</a>
            <a href="#harga" data-nav-link class="nav-link text-sm text-ink-soft transition-colors hover:text-ink">Paket</a>
        </div>

        {{-- Blok auth tampil kalau pengguna sudah login; bagian else-nya kalau belum login --}}
        <div class="hidden items-center gap-2 md:flex">
            @auth
                <a href="{{ url('/dashboard') }}" class="rounded-lg bg-brand px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-brand-dark">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="rounded-lg border border-line px-4 py-2 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">Masuk</a>
                <a href="{{ url('/register') }}" class="rounded-lg bg-brand px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-brand-dark">Daftar</a>
            @endauth
        </div>

        {{-- Mobile Button --}}
        <button type="button" class="-mr-2 rounded-lg p-2 text-ink md:hidden"
                @click="open = !open" :aria-expanded="open.toString()"
                aria-controls="menu-mobile" aria-label="Menu">
            <svg x-show="!open" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            <svg x-show="open" x-cloak class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>
        </button>
    </nav>

    {{-- Menu mobile --}}
    <div id="menu-mobile" x-show="open" x-cloak class="border-t border-line md:hidden">
        <div class="mx-auto max-w-[1180px] px-6 py-3">
            <a href="#beranda" @click="open = false" class="block border-b border-line py-3 text-sm text-ink">Beranda</a>
            <a href="#cara-kerja" @click="open = false" class="block border-b border-line py-3 text-sm text-ink">Cara Kerja</a>
            <a href="#fitur" @click="open = false" class="block border-b border-line py-3 text-sm text-ink">Fitur</a>
            <a href="#harga" @click="open = false" class="block border-b border-line py-3 text-sm text-ink">Paket</a>

            <div class="flex gap-2 py-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="flex-1 rounded-lg bg-brand px-4 py-2.5 text-center text-sm font-semibold text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="flex-1 rounded-lg border border-line px-4 py-2.5 text-center text-sm font-semibold text-ink">Masuk</a>
                    <a href="{{ url('/register') }}" class="flex-1 rounded-lg bg-brand px-4 py-2.5 text-center text-sm font-semibold text-white">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- ============================================================
     HERO — latar terang, aksen biru kuat, foto dokumentasi
     ============================================================ --}}
<section id="beranda" class="scroll-mt-16 bg-surface py-14 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">

            <div>
                <p class="hero-in text-sm font-semibold text-brand">Untuk acara sekolah</p>

                <h1 class="hero-in mt-3 font-display text-4xl font-bold leading-[1.08] tracking-tight text-ink sm:text-5xl lg:text-[3.5rem]">
                    Atur fotografer, simpan hasilnya, <span class="text-brand">bagikan ke orang tua.</span>
                </h1>

                <p class="hero-in mt-5 max-w-lg text-base leading-relaxed text-ink-soft md:text-lg">
                    Panitia pilih tanggal dan paket, fotografer datang sesuai jadwal, lalu hasil foto masuk ke galeri. Nggak perlu lagi kirim file lewat WhatsApp.
                </p>

                {{-- Tombol utama mengikuti status login:
                     belum login -> daftar dulu, sudah login -> langsung cek ketersediaan --}}
                <div class="hero-in mt-8 flex flex-wrap gap-3">
                    @auth
                        <a href="{{ route('availability.index') }}" class="rounded-lg bg-brand px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-brand-dark">Cek Ketersediaan</a>
                    @else
                        <a href="{{ url('/register') }}" class="rounded-lg bg-brand px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-brand-dark">Daftar untuk Booking</a>
                    @endauth
                    <a href="{{ url('/dashboard') }}" class="rounded-lg border border-line px-6 py-3 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">Buka Dashboard</a>
                </div>
            </div>

            {{-- Foto hanya tampil kalau file-nya benar-benar ada di public/images.
                 Kalau belum ada, hero tampil tanpa foto (tidak ada gambar rusak). --}}
            @if (file_exists(public_path('images/wisuda2.webp')))
                <div class="hero-in relative pb-3 pr-3">
                    <div class="absolute inset-0 translate-x-3 translate-y-3 rounded-xl bg-brand"></div>
                    <img src="{{ asset('images/wisuda2.webp') }}"
                         alt="Dokumentasi acara sekolah"
                         width="960" height="1080"
                         class="relative aspect-[4/3] w-full rounded-xl object-cover lg:aspect-[5/6] lg:max-h-[540px]">
                </div>
            @endif

        </div>
    </div>
</section>

{{-- ============================================================
     CARA KERJA — latar biru muda, nomor langkah menonjol
     ============================================================ --}}
<section id="cara-kerja" class="scroll-mt-16 bg-brand-soft py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        <div class="reveal max-w-xl">
            <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">Dari booking sampai galeri</h2>
            <p class="mt-3 text-ink-soft">Prosesnya sama untuk acara apa pun, dari rapat kelas sampai wisuda.</p>
        </div>

        {{-- <ol> = daftar berurutan. Garis di sebelah nomor menghubungkan satu langkah ke langkah berikutnya. --}}
        <ol class="mt-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">1</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Cek jadwal, pilih paket</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">Lihat fotografer yang kosong di tanggal acaramu, lalu pilih paket yang sesuai.</p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">2</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Booking dan bayar</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">Isi detail acara, kirim bukti pembayaran, dan tunggu konfirmasi fotografer.</p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">3</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Fotografer datang</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">Fotografer meliput acara sesuai tanggal, jam, dan lokasi yang kamu isi.</p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">4</span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Terima foto di galeri</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">Hasil foto masuk ke galeri acara. Unduh sekaligus, lalu bagikan ke siswa dan orang tua.</p>
            </li>
        </ol>
    </div>
</section>

{{-- ============================================================
     FITUR — latar putih. Satu kotak dibagi dua: kiri biru (fitur utama),
     kanan putih (fitur lainnya, beraksen cyan)
     ============================================================ --}}
<section id="fitur" class="scroll-mt-16 bg-surface py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        <div class="reveal max-w-xl">
            <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">Yang bisa panitia lakukan di Momenta</h2>
            <p class="mt-3 text-ink-soft">Dari mencari fotografer yang kosong sampai menerima hasil foto, semuanya ada di satu tempat.</p>
        </div>

        <div class="mt-10 grid overflow-hidden rounded-xl border border-line lg:grid-cols-2">

            {{-- Setengah biru: fitur yang paling ditonjolkan --}}
            <div class="flex flex-col justify-center bg-brand p-8 text-white md:p-12">
                <p class="text-sm font-semibold text-blue-100">Fitur utama</p>
                <h3 class="mt-2 font-display text-2xl font-bold md:text-3xl">Cek ketersediaan fotografer</h3>
                <p class="mt-3 max-w-md leading-relaxed text-blue-100">
                    Masukkan tanggal dan jam acara, lalu lihat fotografer yang masih kosong. Tidak perlu menghubungi mereka satu per satu.
                </p>
                <a href="{{ route('availability.index') }}"
                   class="mt-7 inline-flex w-fit items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-brand transition-colors hover:bg-brand-soft">
                    Cek ketersediaan
                </a>
            </div>

            {{-- Setengah putih: tiga fitur lain --}}
            <div class="space-y-4 bg-surface p-6 md:p-10">
                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5">
                    <h3 class="font-semibold text-ink">Booking dan pembayaran online</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">Pilih paket, isi jadwal dan lokasi, lalu unggah bukti pembayaran dari satu alur.</p>
                </div>
                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5">
                    <h3 class="font-semibold text-ink">Galeri per acara</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">Foto hasil sesi dikumpulkan per acara dan bisa diunduh sekaligus.</p>
                </div>
                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5">
                    <h3 class="font-semibold text-ink">Status booking</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">Pantau booking dari diajukan sampai acara selesai.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     PAKET HARGA — latar abu-abu kebiruan, kartu putih
     Data $pakets dikirim dari route '/' (web.php), diambil dari database.
     ============================================================ --}}
<section id="harga" class="scroll-mt-16 bg-slate-100 py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        @if ($pakets->isEmpty())
            <div class="reveal max-w-xl">
                <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">Paket dan harga</h2>
            </div>
            <p class="mt-8 rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-ink-soft">
                Belum ada paket yang tersedia saat ini.
            </p>
        @else
            {{-- x-data="paketSlider" = logika slider ada di resources/js/paket-slider.js --}}
            <div x-data="paketSlider">

                <div class="flex items-end justify-between gap-6">
                    <div class="reveal max-w-xl">
                        <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">Paket dan harga</h2>
                        <p class="mt-3 text-ink-soft">Harga per sesi. Pilih paket, lalu lanjut ke booking.</p>
                    </div>

                    {{-- Panah kiri/kanan (hanya kalau paketnya lebih dari satu) --}}
                    @if ($pakets->count() > 1)
                        <div class="flex shrink-0 gap-2">
                            <button type="button" @click="prev()" :disabled="!canScrollLeft" aria-label="Paket sebelumnya"
                                    class="slider-arrow flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300 bg-white text-ink transition-colors hover:border-brand hover:text-brand disabled:pointer-events-none disabled:opacity-40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                            </button>
                            <button type="button" @click="next()" :disabled="!canScrollRight" aria-label="Paket berikutnya"
                                    class="slider-arrow flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300 bg-white text-ink transition-colors hover:border-brand hover:text-brand disabled:pointer-events-none disabled:opacity-40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Baris kartu yang bisa digeser (drag dengan mouse, swipe di HP) --}}
                <div
                    x-ref="slider"
                    :style="hasDragged ? 'scroll-snap-type: none' : ''"
                    @scroll.passive="updateEdges()"
                    @pointerdown="startDrag($event)"
                    @pointermove="duringDrag($event)"
                    @pointerup="endDrag()"
                    @pointercancel="endDrag()"
                    @pointerleave="pointerLeave()"
                    @mouseenter="pauseAutoSlide()"
                    @mouseleave="resumeAutoSlide()"
                    tabindex="0"
                    role="region"
                    aria-label="Daftar paket"
                    class="package-slider mt-8 flex snap-x snap-mandatory items-stretch gap-5 overflow-x-auto pb-2 cursor-grab select-none active:cursor-grabbing [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
                >
                    {{-- Perulangan foreach: satu kartu untuk setiap paket dari database --}}
                    @foreach ($pakets as $paket)
                        {{-- Paket populer: border biru tebal. Paket lain: border abu-abu tipis. --}}
                        <article class="package-card flex w-[280px] shrink-0 snap-start flex-col rounded-xl bg-white p-6 sm:w-[300px] {{ $paket->is_populer && $paket->tersedia ? 'border-2 border-brand' : 'border border-line' }} {{ $paket->tersedia ? '' : 'opacity-75' }}">

                            {{-- Paket yang tidak ada diberi label abu-abu (menggantikan label populer) --}}
                            @if (! $paket->tersedia)
                                <span class="mb-3 w-fit rounded-md bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700">Tidak tersedia</span>
                            @elseif ($paket->is_populer)
                                <span class="mb-3 w-fit rounded-md bg-brand px-2.5 py-1 text-xs font-semibold text-white">Paling populer</span>
                            @endif

                            <h3 class="font-display text-lg font-semibold text-ink">{{ $paket->judul }}</h3>
                            <p class="mt-1 text-sm text-ink-soft">{{ $paket->deskripsi }}</p>

                            <p class="mt-5 font-display text-3xl font-bold text-ink">
                                {{ $paket->harga_formatted }}<span class="ml-1 text-sm font-normal text-ink-soft">/sesi</span>
                            </p>

                            <ul class="mt-5 flex-1 space-y-2.5 border-t border-line pt-5 text-sm text-ink-soft">
                                <li class="flex items-start gap-2.5">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 7 9 18l-5-5"/></svg>
                                    {{ $paket->durasi }} sesi foto
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 7 9 18l-5-5"/></svg>
                                    {{ $paket->jumlah_foto }}
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 7 9 18l-5-5"/></svg>
                                    {{ $paket->jumlah_fotografer }}
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 stroke-brand" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 7 9 18l-5-5"/></svg>
                                    {{ $paket->durasi_galeri }}
                                </li>
                            </ul>

                            {{-- Kalau paket ada: tampilkan link ke form booking.
                                 Kalau tidak ada: tombol abu-abu yang tidak bisa diklik. --}}
                            @if ($paket->tersedia)
                                <a href="{{ route('booking.show', ['id' => $paket->fotografer_id, 'paket' => $paket->paket_id]) }}"
                                   class="mt-6 inline-flex items-center justify-center rounded-lg px-5 py-2.5 text-sm font-semibold transition-colors {{ $paket->is_populer ? 'bg-brand text-white hover:bg-brand-dark' : 'border border-slate-300 text-ink hover:border-brand hover:text-brand' }}">
                                    Pilih paket
                                </a>
                            @else
                                <span class="mt-6 inline-flex cursor-not-allowed items-center justify-center rounded-lg bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-500" aria-disabled="true">
                                    Tidak tersedia
                                </span>
                            @endif
                        </article>
                    @endforeach
                </div>

                {{-- Titik penanda posisi kartu --}}
                @if ($pakets->count() > 1)
                    <div class="mt-4 flex items-center justify-center">
                        @foreach ($pakets as $paket)
                            <button type="button" @click="scrollToIndex({{ $loop->index }})"
                                    aria-label="Ke paket {{ $loop->iteration }}"
                                    :aria-current="current === {{ $loop->index }} ? 'true' : 'false'"
                                    class="p-1.5">
                                <span class="block h-2.5 w-2.5 rounded-full transition-colors"
                                      :class="current === {{ $loop->index }} ? 'bg-brand' : 'bg-slate-300'"></span>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     CTA — latar biru tua, teks putih, tombol kontras
     ============================================================ --}}
<section class="bg-navy">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-8 px-6 py-14 md:flex-row md:items-center md:justify-between md:px-8 md:py-16">
        <div class="reveal max-w-lg">
            <h2 class="font-display text-2xl font-bold tracking-tight text-white md:text-3xl">Ada acara sekolah bulan depan?</h2>
            <p class="mt-3 text-blue-100">Cek jadwal fotografer dan booking dari satu tempat.</p>
        </div>

        <div class="flex flex-wrap gap-3">
            @auth
                <a href="{{ route('availability.index') }}" class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-navy transition-colors hover:bg-brand-soft">Cek ketersediaan</a>
            @else
                <a href="{{ url('/register') }}" class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-navy transition-colors hover:bg-brand-soft">Daftar sekarang</a>
            @endauth
            <a href="{{ url('/dashboard') }}" class="rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white transition-colors hover:border-white">Buka Dashboard</a>
        </div>
    </div>
</section>

{{-- ============================================================
     FOOTER — netral
     ============================================================ --}}
<footer class="border-t border-line bg-page py-10">
    <div class="mx-auto flex max-w-[1180px] flex-col gap-6 px-6 md:flex-row md:items-center md:justify-between md:px-8">
        <a href="#beranda" class="shrink-0">
            <img src="{{ asset('images/Logo.svg') }}" alt="Momenta" width="100" class="h-auto">
        </a>

        <nav aria-label="Footer" class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-ink-soft">
            <a href="#beranda" class="transition-colors hover:text-ink">Beranda</a>
            <a href="#cara-kerja" class="transition-colors hover:text-ink">Cara Kerja</a>
            <a href="#fitur" class="transition-colors hover:text-ink">Fitur</a>
            <a href="#harga" class="transition-colors hover:text-ink">Paket</a>
            <a href="{{ url('/dashboard') }}" class="transition-colors hover:text-ink">Dashboard</a>
        </nav>

        <p class="text-sm text-ink-soft">© {{ date('Y') }} Momenta.</p>
    </div>
</footer>

</body>
</html>