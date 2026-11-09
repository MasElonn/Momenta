<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Fotografer — Momenta</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-sans text-ink antialiased min-h-screen flex flex-col justify-between">

    <div>
        <x-navbar />

        <main class="mx-auto max-w-[1180px] px-6 py-10 md:px-8">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="font-display text-2xl font-bold tracking-tight text-ink md:text-3xl">
                        Fotografer Momenta
                    </h1>
                    <p class="mt-2 text-sm text-ink-soft">
                        Pilih fotografer terbaik yang siap mengabadikan momen penting acara sekolahmu.
                    </p>
                </div>

                <form action="{{ route('fotografer.browse') }}" method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text"
                               name="q"
                               value="{{ $search ?? '' }}"
                               placeholder="Cari nama atau kota..."
                               class="w-56 sm:w-64 rounded-lg border border-line bg-white px-3.5 py-2 text-sm text-ink placeholder:text-slate-400 focus:border-brand focus:outline-hidden focus:ring-1 focus:ring-brand">
                    </div>
                    <button type="submit"
                            class="rounded-lg bg-brand px-4 py-2 text-sm font-semibold text-white transition hover:bg-brand-dark">
                        Cari
                    </button>
                    @if (!empty($search))
                        <a href="{{ route('fotografer.browse') }}"
                           class="rounded-lg border border-line bg-white px-3 py-2 text-sm text-ink-soft hover:text-ink"
                           title="Reset pencarian">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            @if ($fotografer->isEmpty())
                <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <p class="font-medium text-ink">
                        @if (!empty($search))
                            Tidak ada fotografer dengan kata kunci "{{ $search }}".
                        @else
                            Belum ada fotografer aktif yang tersedia saat ini.
                        @endif
                    </p>
                    <p class="mt-1 text-sm text-ink-soft">
                        @if (!empty($search))
                            <a href="{{ route('fotografer.browse') }}" class="text-brand font-semibold hover:underline">Tampilkan semua fotografer</a>
                        @else
                            Silakan periksa kembali nanti.
                        @endif
                    </p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($fotografer as $item)
                        <x-fotografer-card :item="$item" />
                    @endforeach
                </div>

                @if ($fotografer->hasPages())
                    <div class="mt-10">
                        {{ $fotografer->links() }}
                    </div>
                @endif
            @endif
        </main>
    </div>

    <footer class="border-t border-line bg-white py-8 mt-16">
        <div class="mx-auto flex max-w-[1180px] flex-col gap-4 px-6 md:flex-row md:items-center md:justify-between md:px-8">
            <p class="text-xs text-ink-soft">
                © {{ date('Y') }} Momenta. Galeri & Booking Fotografer Acara Sekolah.
            </p>
            <div class="flex gap-4 text-xs text-ink-soft">
                <a href="{{ url('/') }}" class="hover:text-brand">Beranda</a>
                <a href="{{ route('fotografer.browse') }}" class="hover:text-brand font-semibold text-brand">Fotografer</a>
                <a href="{{ url('/dashboard') }}" class="hover:text-brand">Dashboard</a>
            </div>
        </div>
    </footer>

</body>
</html>

