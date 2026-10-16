@csrf
@if (isset($paket))
    @method('PUT')
@endif

<div class="space-y-7">

    {{-- Section: Informasi Dasar --}}
    <div>
        <div class="mb-4 flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-brand">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            Informasi Dasar
        </div>

        <div class="space-y-5">
            <div>
                <label class="mb-2 block text-sm text-ink-soft">Judul Paket</label>
                <div class="relative">
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-soft/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41 11 3.83A2 2 0 0 0 9.58 3.2L4 3a1 1 0 0 0-1 1l.2 5.58a2 2 0 0 0 .63 1.42l9.58 9.58a2 2 0 0 0 2.83 0l4.35-4.35a2 2 0 0 0 0-2.82Z"/><circle cx="7.5" cy="7.5" r="1"/></svg>
                    <input type="text" name="judul" x-model="judul"
                           placeholder="Contoh: Paket Wedding Exclusive Gold"
                           class="w-full rounded-lg border border-line py-3 pl-10 pr-4 text-sm text-ink placeholder:text-ink-soft/60 focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand">
                </div>
                @error('judul')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm text-ink-soft">Deskripsi Paket</label>
                <textarea name="deskripsi" x-model="deskripsi" rows="3"
                          placeholder="Jelaskan detail cakupan layanan, alat yang digunakan, dan hasil akhir..."
                          class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink placeholder:text-ink-soft/60 focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand"></textarea>
                @error('deskripsi')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm text-ink-soft">Harga Paket</label>
                <div class="flex items-center rounded-lg border border-line px-4 py-3 focus-within:border-brand focus-within:ring-1 focus-within:ring-brand">
                    <span class="mr-2 text-sm text-ink-soft">Rp</span>
                    <input type="number" step="1" min="0" name="harga" x-model="harga"
                           placeholder="2500000"
                           class="w-full border-0 p-0 text-sm text-ink placeholder:text-ink-soft/60 focus:outline-none focus:ring-0">
                    <span class="ml-2 shrink-0 rounded-md bg-brand-soft px-2 py-1 text-[11px] font-semibold text-brand" x-text="hargaFormatted"></span>
                </div>
                @error('harga')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Section: Detail Layanan --}}
    <div>
        <div class="mb-4 flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-brand">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            Detail Layanan
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label class="mb-2 flex items-center gap-1.5 text-sm text-ink-soft">
                    <svg class="h-3.5 w-3.5 text-ink-soft/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                    Durasi Sesi
                </label>
                <input type="text" name="durasi" x-model="durasi"
                       placeholder="90 menit"
                       class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink placeholder:text-ink-soft/60 focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand">
                @error('durasi')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 flex items-center gap-1.5 text-sm text-ink-soft">
                    <svg class="h-3.5 w-3.5 text-ink-soft/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="7" width="18" height="13" rx="2"/><circle cx="12" cy="13.5" r="3"/></svg>
                    Jumlah Foto
                </label>
                <input type="text" name="jumlah_foto" x-model="jumlah_foto"
                       placeholder="25 foto hasil edit"
                       class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink placeholder:text-ink-soft/60 focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand">
                @error('jumlah_foto')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 flex items-center gap-1.5 text-sm text-ink-soft">
                    <svg class="h-3.5 w-3.5 text-ink-soft/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Jumlah Fotografer
                </label>
                <input type="text" name="jumlah_fotografer" x-model="jumlah_fotografer"
                       placeholder="1 fotografer + asisten"
                       class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink placeholder:text-ink-soft/60 focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand">
                @error('jumlah_fotografer')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 flex items-center gap-1.5 text-sm text-ink-soft">
                    <svg class="h-3.5 w-3.5 text-ink-soft/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    Durasi Galeri Online
                </label>
                <input type="text" name="durasi_galeri" x-model="durasi_galeri"
                       placeholder="Galeri online 90 hari"
                       class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink placeholder:text-ink-soft/60 focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand">
                @error('durasi_galeri')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Section: Visibilitas --}}
    <div>
        <label class="flex cursor-pointer items-center justify-between rounded-xl border border-line bg-page px-5 py-4">
            <span class="flex items-center gap-2.5">
                <svg class="h-4 w-4 text-brand" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.6 7.1.6-5.4 4.7 1.7 6.9-6.3-3.8-6.3 3.8 1.7-6.9L2 9.2l7.1-.6L12 2z"/></svg>
                <span>
                    <span class="block text-sm font-medium text-ink">Jadikan paket populer</span>
                    <span class="block text-xs text-ink-soft">Ditandai "Paling Populer" dan disorot di landing page</span>
                </span>
            </span>

            <span class="relative inline-flex h-6 w-11 shrink-0 items-center rounded-full transition-colors"
                  :class="is_populer ? 'bg-brand' : 'bg-line'">
                <input type="checkbox" name="is_populer" value="1" x-model="is_populer" class="peer sr-only">
                <span class="inline-block h-4.5 w-4.5 transform rounded-full bg-surface shadow transition-transform"
                      :class="is_populer ? 'translate-x-6' : 'translate-x-1'"></span>
            </span>
        </label>
    </div>
</div>

<div class="mt-8 flex items-center justify-end gap-3 border-t border-line pt-6">
    <a href="{{ route('dashboard', ['tab' => 'paket']) }}"
       class="inline-flex items-center justify-center rounded-full border border-line px-6 py-2.5 text-sm font-medium text-ink transition hover:border-ink-soft">
        Batal
    </a>
    <button type="submit"
            class="inline-flex items-center justify-center gap-1.5 rounded-full bg-brand px-6 py-2.5 text-sm font-semibold text-surface transition hover:-translate-y-0.5 hover:bg-brand-dark">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
        {{ isset($paket) ? 'Simpan Perubahan' : 'Simpan' }}
    </button>
</div>