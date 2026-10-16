@php
    $pakets = \App\Models\Paket::where('fotografer_id', Auth::id())
        ->latest()
        ->get();
@endphp

<div>
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-lg font-semibold text-ink">Paket Saya</h2>
            <p class="mt-0.5 text-sm text-ink-soft">
                {{ $pakets->count() }} paket aktif · tampil otomatis di landing page
            </p>
        </div>
        <a href="{{ route('paket.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-brand px-4 py-2.5 text-sm font-semibold text-surface shadow-sm transition hover:-translate-y-0.5 hover:bg-brand-dark hover:shadow-md">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Paket
        </a>
    </div>

    @if (session('success'))
        <div class="mb-5 flex items-center gap-2.5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($pakets->isEmpty())
        <div class="flex flex-col items-center justify-center gap-4 rounded-2xl border-2 border-dashed border-line bg-page px-6 py-20 text-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-soft text-brand">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            </div>
            <div>
                <p class="font-semibold text-ink">Belum ada paket</p>
                <p class="mt-1 text-sm text-ink-soft">Paket yang kamu buat bakal langsung muncul di landing page.</p>
            </div>
            <a href="{{ route('paket.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-surface transition hover:bg-brand-dark">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Buat paket fotografi pertamamu
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($pakets as $paket)
                <div class="group relative flex flex-col rounded-2xl border border-line bg-surface p-6 transition-all duration-300 hover:-translate-y-1 hover:border-brand/40 hover:shadow-lg">

                    <div class="mb-3 flex items-center justify-between">
                        <span class="font-mono text-[11px] text-ink-soft">#{{ $paket->paket_id }}</span>
                        @if ($paket->is_populer)
                            <span class="inline-flex items-center gap-1 rounded-full bg-brand-soft px-2.5 py-1 text-[11px] font-semibold text-brand">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.6 7.1.6-5.4 4.7 1.7 6.9-6.3-3.8-6.3 3.8 1.7-6.9L2 9.2l7.1-.6L12 2z"/></svg>
                                Populer
                            </span>
                        @endif
                    </div>

                    <h3 class="mb-1 text-base font-bold text-navy">{{ $paket->judul }}</h3>
                    <p class="mb-4 line-clamp-2 text-sm text-ink-soft">{{ $paket->deskripsi }}</p>

                    <div class="mb-4 flex items-baseline gap-1">
                        <span class="text-2xl font-extrabold text-brand">{{ $paket->harga_formatted }}</span>
                        <span class="text-xs font-medium text-ink-soft">/sesi</span>
                    </div>

                    <div class="mb-5 grid grid-cols-2 gap-2.5 border-t border-line pt-4 text-xs text-ink-soft">
                        <div class="flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 shrink-0 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                            <span class="truncate">{{ $paket->durasi }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 shrink-0 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="7" width="18" height="13" rx="2"/><circle cx="12" cy="13.5" r="3"/></svg>
                            <span class="truncate">{{ $paket->jumlah_foto }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 shrink-0 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span class="truncate">{{ $paket->jumlah_fotografer }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5 shrink-0 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                            <span class="truncate">{{ $paket->durasi_galeri }}</span>
                        </div>
                    </div>

                    <div class="mt-auto flex gap-2">
                        <a href="{{ route('paket.edit', $paket) }}"
                           class="flex flex-1 items-center justify-center gap-1.5 rounded-lg border border-line py-2 text-xs font-semibold text-navy transition hover:border-brand hover:bg-brand-soft hover:text-brand">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            Edit
                        </a>
                        <form action="{{ route('paket.destroy', $paket) }}" method="POST"
                              onsubmit="return confirm('Apakah kamu yakin ingin menghapus paket ini?');"
                              class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex w-full items-center justify-center gap-1.5 rounded-lg border border-line py-2 text-xs font-semibold text-red-600 transition hover:border-red-200 hover:bg-red-50">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>