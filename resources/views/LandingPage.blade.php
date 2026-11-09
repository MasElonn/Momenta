<!DOCTYPE html>
<html lang="id" class="scroll-smooth motion-reduce:scroll-auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momenta | Galeri & Booking Fotografer Acara Sekolah</title>
    <meta name="description" content="Booking fotografer untuk acara sekolah, pilih paket, dan simpan hasil foto di galeri online.">

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
                    Untuk acara sekolah
                </p>

                <h1 class="hero-in mt-3 font-display text-4xl font-bold leading-[1.08] tracking-tight text-ink sm:text-5xl lg:text-[3.5rem]">
                    Atur fotografer, simpan hasilnya,
                    <span class="text-brand">bagikan ke orang tua.</span>
                </h1>

                <p class="hero-in mt-5 max-w-lg text-base leading-relaxed text-ink-soft md:text-lg">
                    Panitia pilih tanggal dan paket, fotografer datang sesuai jadwal, lalu hasil foto masuk ke galeri. Nggak perlu lagi kirim file lewat WhatsApp.
                </p>

                <div class="hero-in mt-8 flex flex-wrap gap-3">
                    @auth
                        <a href="#fotografer"
                           class="rounded-lg bg-brand px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-dark">
                            Cek Ketersediaan
                        </a>

                        <a href="{{ url('/dashboard') }}"
                           class="rounded-lg border border-line px-6 py-3 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="rounded-lg bg-brand px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-dark">
                            Daftar untuk Booking
                        </a>

                        <a href="{{ route('login') }}"
                           class="rounded-lg border border-line px-6 py-3 text-sm font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                            Masuk
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
                Dari booking sampai galeri
            </h2>

            <p class="mt-3 text-ink-soft">
                Prosesnya sama untuk acara apa pun, dari rapat kelas sampai wisuda.
            </p>
        </div>

        <ol class="reveal-stagger mt-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">1</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Pilih fotografer dan paket</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    Pilih fotografer dan paket. Ketersediaan jadwal akan diperiksa langsung pada formulir booking.
                </p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">2</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Booking dan bayar</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    Isi detail acara, kirim bukti pembayaran, dan tunggu konfirmasi fotografer.
                </p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">3</span>
                    <span class="ml-4 hidden h-0.5 flex-1 bg-brand/30 lg:block"></span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Fotografer datang</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    Fotografer meliput acara sesuai tanggal, jam, dan lokasi yang kamu isi.
                </p>
            </li>

            <li>
                <div class="flex items-center">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand font-display text-xl font-bold text-white">4</span>
                </div>
                <h3 class="mt-5 font-semibold text-ink">Terima foto di galeri</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">
                    Hasil foto masuk ke galeri acara. Unduh sekaligus, lalu bagikan ke siswa dan orang tua.
                </p>
            </li>
        </ol>
    </div>
</section>

<section id="fitur" class="scroll-mt-20 bg-surface py-16 md:py-20">
    <div class="mx-auto max-w-[1180px] px-6 md:px-8">

        <div class="reveal max-w-xl">
            <h2 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">
                Yang bisa panitia lakukan di Momenta
            </h2>

            <p class="mt-3 text-ink-soft">
                Dari mencari fotografer yang kosong sampai menerima hasil foto, semuanya ada di satu tempat.
            </p>
        </div>

        <div class="reveal mt-10 grid overflow-hidden rounded-xl border border-line lg:grid-cols-2">

            <div class="flex flex-col justify-center bg-brand p-8 text-white md:p-12">
                <p class="text-sm font-semibold text-blue-100">Fitur utama</p>

                <h3 class="mt-2 font-display text-2xl font-bold md:text-3xl">
                    Pengecekan jadwal saat booking
                </h3>

                <p class="mt-3 max-w-md leading-relaxed text-blue-100">
                    Pilih fotografer dan paket terlebih dahulu. Selanjutnya, masukkan tanggal serta jam acara pada formulir booking untuk memeriksa apakah jadwal fotografer tersedia.
                </p>

                <a href="#fotografer"
                   class="mt-7 inline-flex w-fit items-center justify-center rounded-lg bg-white px-6 py-3 text-sm font-semibold text-brand transition-all duration-300 hover:-translate-y-0.5 hover:bg-brand-soft">
                    Pilih fotografer
                </a>
            </div>

            <div class="space-y-4 bg-surface p-6 md:p-10">
                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5 transition-transform duration-300 hover:translate-x-1">
                    <h3 class="font-semibold text-ink">Booking dan pembayaran online</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">
                        Pilih paket, isi jadwal dan lokasi, lalu unggah bukti pembayaran dari satu alur.
                    </p>
                </div>

                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5 transition-transform duration-300 hover:translate-x-1">
                    <h3 class="font-semibold text-ink">Galeri per acara</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">
                        Foto hasil sesi dikumpulkan per acara dan bisa diunduh sekaligus.
                    </p>
                </div>

                <div class="border-l-4 border-cyan-500 bg-slate-50 p-5 transition-transform duration-300 hover:translate-x-1">
                    <h3 class="font-semibold text-ink">Status booking</h3>
                    <p class="mt-1 text-sm leading-relaxed text-ink-soft">
                        Pantau booking dari diajukan sampai acara selesai.
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
                Pilih fotografer
            </h2>

            <p class="mt-3 text-ink-soft">
                Lihat fotografer yang tersedia dan pilih paket sesuai kebutuhan acaramu.
            </p>
        </div>

        @if ($fotografer->isEmpty())
            <p class="mt-8 rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-ink-soft">
                Belum ada fotografer yang tersedia.
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
                        Lihat Semua Fotografer
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
                Ada acara sekolah bulan depan?
            </h2>

            <p class="mt-3 text-blue-100">
                Pilih fotografer, tentukan jadwal, lalu lanjutkan proses booking dari satu tempat.
            </p>
        </div>

        <div class="reveal flex flex-wrap gap-3">
            @auth
                <a href="#fotografer"
                   class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-navy transition-colors hover:bg-brand-soft">
                    Pilih fotografer
                </a>

                <a href="{{ url('/dashboard') }}"
                   class="rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white transition-colors hover:border-white">
                    Buka Dashboard
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-navy transition-colors hover:bg-brand-soft">
                    Daftar sekarang
                </a>

                <a href="{{ route('login') }}"
                   class="rounded-lg border border-white/40 px-6 py-3 text-sm font-semibold text-white transition-colors hover:border-white">
                    Masuk
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

            <a href="#beranda" class="transition-colors hover:text-ink">Beranda</a>
            <a href="#cara-kerja" class="transition-colors hover:text-ink">Cara Kerja</a>
            <a href="#fitur" class="transition-colors hover:text-ink">Fitur</a>
            <a href="#fotografer" class="transition-colors hover:text-ink">Fotografer</a>
            <a href="{{ url('/dashboard') }}" class="transition-colors hover:text-ink">Dashboard</a>
        </nav>

        <p class="text-sm text-ink-soft">
            © {{ date('Y') }} Momenta.
        </p>
    </div>
</footer>

</body>
</html>