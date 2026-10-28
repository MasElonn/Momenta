<x-dashboard.shell current="availability" title="Cek Ketersediaan Fotografer">
    <div class="mx-auto max-w-5xl">

        <div
            x-data="availabilityCheck"
            data-check-url="{{ route('availability.check') }}"
        >
            {{-- Heading --}}
            <div class="mb-8">
                <h1 class="font-display text-[26px] font-bold tracking-tight text-navy sm:text-[30px]">
                    Cek Ketersediaan Fotografer
                </h1>
                <p class="mt-2 text-[14.5px] leading-relaxed text-ink-soft">
                    Pilih tanggal dan waktu acara untuk melihat fotografer yang tersedia.
                </p>
            </div>

            {{-- Form --}}
            <form @submit.prevent="check()" class="rounded-2xl border border-line bg-surface p-6 shadow-sm sm:p-7">
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                    <div>
                        <label for="tanggal" class="mb-2 block text-sm text-ink-soft">Tanggal Acara</label>
                        <input
                            type="date" id="tanggal" x-model="tanggal"
                            placeholder="Pilih tanggal acara"
                            class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand"
                        >
                        <p class="mt-1.5 text-xs text-red-600" x-show="firstError('tanggal')" x-text="firstError('tanggal')"></p>
                    </div>

                    <div>
                        <label for="waktu_mulai" class="mb-2 block text-sm text-ink-soft">Waktu Mulai</label>
                        <input
                            type="time" id="waktu_mulai" x-model="waktuMulai"
                            placeholder="Pilih waktu mulai"
                            class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand"
                        >
                        <p class="mt-1.5 text-xs text-red-600" x-show="firstError('waktu_mulai')" x-text="firstError('waktu_mulai')"></p>
                    </div>

                    <div>
                        <label for="waktu_selesai" class="mb-2 block text-sm text-ink-soft">Waktu Selesai</label>
                        <input
                            type="time" id="waktu_selesai" x-model="waktuSelesai"
                            placeholder="Pilih waktu selesai"
                            class="w-full rounded-lg border border-line px-4 py-3 text-sm text-ink focus:border-brand focus:outline-none focus:ring-1 focus:ring-brand"
                        >
                        <p class="mt-1.5 text-xs text-red-600" x-show="firstError('waktu_selesai')" x-text="firstError('waktu_selesai')"></p>
                    </div>
                </div>

                <p class="mt-3 text-xs text-red-600" x-show="firstError('general')" x-text="firstError('general')"></p>

                <button
                    type="submit"
                    :disabled="loading"
                    class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-[10px] bg-brand px-6 py-3 text-sm font-semibold text-surface transition hover:bg-brand-dark disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto"
                >
                    <svg x-show="loading" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    <span x-text="loading ? 'Sedang mengecek ketersediaan...' : 'Cek Ketersediaan'"></span>
                </button>
            </form>

            {{-- Results --}}
            <div x-show="submitted && !loading" class="mt-10" style="display: none;">

                <template x-if="fotografer.length > 0">
                    <div>
                        <p class="mb-5 text-sm font-medium text-ink-soft">
                            <span class="font-semibold text-navy" x-text="jumlahTersedia"></span>
                            fotografer tersedia
                        </p>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                            <template x-for="f in fotografer" :key="f.id">
                                <div
                                    class="flex flex-col rounded-2xl border bg-surface p-6 shadow-sm transition-all duration-300"
                                    :class="f.tersedia ? 'border-line hover:-translate-y-1 hover:border-brand/40 hover:shadow-lg' : 'border-line opacity-70'"
                                >
                                    <div class="mb-4 flex items-center gap-3.5">
                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-brand-soft text-sm font-bold text-brand" x-text="initials(f.nama)"></div>
                                        <div class="min-w-0">
                                            <h3 class="truncate text-[15px] font-semibold text-navy" x-text="f.nama"></h3>
                                            <p class="text-xs text-ink-soft">Fotografer Acara Sekolah</p>
                                        </div>
                                    </div>

                                    <div
                                        class="mb-4 inline-flex w-fit items-center gap-1.5 rounded-full px-2.5 py-1 text-[11px] font-semibold"
                                        :class="f.tersedia ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600'"
                                    >
                                        <span class="h-1.5 w-1.5 rounded-full" :class="f.tersedia ? 'bg-green-600' : 'bg-red-500'"></span>
                                        <span x-text="f.tersedia ? 'Tersedia' : 'Jadwal Tidak Tersedia'"></span>
                                    </div>

                                    <div class="mb-5 space-y-1 text-[13px] text-ink-soft">
                                        <p x-text="f.tanggal"></p>
                                        <p x-text="f.waktu"></p>
                                    </div>

                                    <a
                                        x-show="f.tersedia"
                                        :href="bookingUrl(f.id)"
                                        class="mt-auto inline-flex items-center justify-center rounded-[10px] bg-brand px-4 py-2.5 text-sm font-semibold text-surface transition hover:bg-brand-dark"
                                    >
                                        Pilih Fotografer
                                    </a>
                                    <button
                                        x-show="!f.tersedia"
                                        type="button"
                                        disabled
                                        class="mt-auto inline-flex cursor-not-allowed items-center justify-center rounded-[10px] border border-line px-4 py-2.5 text-sm font-semibold text-ink-soft"
                                    >
                                        Sudah Dibooking
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="fotografer.length === 0">
                    <div class="flex flex-col items-center gap-3 rounded-2xl border-2 border-dashed border-line bg-surface px-6 py-16 text-center">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-soft text-brand">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-navy">Belum ada fotografer yang tersedia</p>
                            <p class="mt-1 text-sm text-ink-soft">Silakan pilih tanggal atau waktu lain.</p>
                        </div>
                        <button
                            type="button"
                            @click="reset()"
                            class="mt-1 inline-flex items-center justify-center rounded-[10px] border border-line px-5 py-2.5 text-sm font-semibold text-navy transition hover:border-brand hover:text-brand"
                        >
                            Coba Waktu Lain
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-dashboard.shell>