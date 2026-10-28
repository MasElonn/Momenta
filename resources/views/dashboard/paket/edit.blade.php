<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen bg-page">

    <div
        x-data="paketPreview({
            judul: @js(old('judul', $paket->judul)),
            deskripsi: @js(old('deskripsi', $paket->deskripsi)),
            harga: @js(old('harga', (string) $paket->harga)),
            durasi: @js(old('durasi', $paket->durasi)),
            jumlah_foto: @js(old('jumlah_foto', $paket->jumlah_foto)),
            jumlah_fotografer: @js(old('jumlah_fotografer', $paket->jumlah_fotografer)),
            durasi_galeri: @js(old('durasi_galeri', $paket->durasi_galeri)),
            is_populer: @js((bool) old('is_populer', $paket->is_populer)),
            tersedia: @js((bool) old('tersedia', $paket->tersedia)),
        })"
        class="mx-auto max-w-5xl px-4 py-10"
    >
        {{-- Logo header --}}
        <div class="mb-6 flex items-center gap-2">
            <x-application-logo class="h-6 w-auto" />
            <span class="text-lg font-bold text-ink">Momenta</span>
        </div>
        <div class="mb-8 border-t border-line"></div>

        {{-- Title --}}
        <h1 class="mb-1 text-2xl font-bold text-ink">Edit Paket</h1>
        <p class="mb-6 text-sm text-ink-soft">
            Perbarui detail paket layanan fotografi Anda.
        </p>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.3fr_1fr]">
            {{-- Form card --}}
            <div class="rounded-2xl border border-line bg-surface p-7 shadow-sm sm:p-8">
                <form action="{{ route('paket.update', $paket) }}" method="POST">
                    @include('dashboard.paket._form')
                </form>
            </div>

            {{-- Live preview --}}
            <div class="lg:sticky lg:top-10 lg:self-start">
                <p class="mb-3 flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wide text-ink-soft">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                    Pratinjau di Landing Page
                </p>

                <div class="transition-all duration-300"
                     :class="is_populer
                        ? 'relative flex flex-col rounded-2xl border border-navy bg-navy p-7 text-surface shadow-[0_30px_60px_-25px_rgba(11,42,140,0.45)]'
                        : 'flex flex-col rounded-2xl border border-line bg-page p-7'">

                    <template x-if="is_populer">
                        <div class="absolute -top-[13px] left-6 rounded-full bg-brand px-3 py-1.5 text-[11px] font-semibold text-surface">Paling Populer</div>
                    </template>

                    <template x-if="!tersedia">
                        <span class="mb-3 inline-block w-fit rounded-md bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700">Tidak tersedia</span>
                    </template>

                    <h3 class="mb-1 text-lg font-semibold" :class="is_populer ? '' : 'text-navy'" x-text="judul || 'Judul Paket'"></h3>
                    <p class="mb-5 text-[13px]" :class="is_populer ? 'text-brand-soft/70' : 'text-ink-soft'" x-text="deskripsi || 'Deskripsi paket akan tampil di sini'"></p>

                    <div class="mb-5 font-display text-[28px] font-bold" :class="is_populer ? 'text-surface' : 'text-navy'">
                        <span x-text="hargaFormatted"></span><span class="text-sm font-medium" :class="is_populer ? 'text-brand-soft/70' : 'text-ink-soft'">/sesi</span>
                    </div>

                    <ul class="mb-6 space-y-2.5 text-sm" :class="is_populer ? 'text-brand-soft/90' : 'text-ink-soft'">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" :class="is_populer ? 'stroke-brand-soft' : 'stroke-brand'" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                            <span x-text="(durasi || '—') + ' sesi foto'"></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" :class="is_populer ? 'stroke-brand-soft' : 'stroke-brand'" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                            <span x-text="jumlah_foto || '—'"></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" :class="is_populer ? 'stroke-brand-soft' : 'stroke-brand'" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                            <span x-text="jumlah_fotografer || '—'"></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" :class="is_populer ? 'stroke-brand-soft' : 'stroke-brand'" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>
                            <span x-text="durasi_galeri || '—'"></span>
                        </li>
                    </ul>

                    <div class="w-full rounded-[10px] py-2.5 text-center text-sm font-semibold"
                         :class="!tersedia ? 'bg-slate-200 text-slate-500' : (is_populer ? 'bg-brand text-surface' : 'border border-line text-navy')"
                         x-text="tersedia ? 'Pilih Paket' : 'Tidak tersedia'"></div>
                </div>

                <p class="mt-3 text-xs text-ink-soft">Ini simulasi tampilan — otomatis update sambil kamu ngisi form.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('paketPreview', (initial) => ({
                ...initial,

                get hargaFormatted() {
                    const value = parseFloat(this.harga) || 0;

                    if (value >= 1_000_000) {
                        let jt = value / 1_000_000;
                        let formatted = jt.toFixed(1).replace('.', ',').replace(/,0$/, '');
                        return 'Rp ' + formatted + 'jt';
                    }
                    if (value >= 1_000) {
                        return 'Rp ' + Math.round(value / 1000) + 'rb';
                    }
                    return 'Rp ' + value.toLocaleString('id-ID');
                },
            }));
        });
    </script>

</body>
</html>