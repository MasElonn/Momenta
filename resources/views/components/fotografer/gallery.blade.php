
<div
    x-show="tab === 'gallery'"
    x-cloak
    x-data="{
        section: 'list',
        transId: null
    }"
    class="space-y-6"
>
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Gallery
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Kelola foto dari acara yang sudah kamu tangani.
            </p>
        </div>
    </div>

    {{-- Daftar booking --}}
    <div x-show="section === 'list'" class="space-y-4">
        @forelse ($transaksis as $transaksi)
            @if ($transaksi->acara)
                <div
                    class="rounded-xl border border-gray-200 bg-white p-4 transition hover:border-gray-300"
                >
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg bg-gray-100">
                            <x-lucide-images class="h-7 w-7 text-gray-500" />
                        </div>

                        <div class="min-w-0 flex-1">
                            <h2 class="font-semibold text-gray-900">
                                {{ $transaksi->acara->judul }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Booking #{{ $transaksi->trans_id }}
                            </p>

                            <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <x-lucide-calendar class="h-4 w-4" />
                                    {{ $transaksi->acara->tanggal?->translatedFormat('d M Y') ?? '-' }}
                                </span>

                                <span>
                                    Paket: {{ $transaksi->paket->judul ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <button
                            type="button"
                            @click="section = 'detail'; transId = '{{ $transaksi->trans_id }}'"
                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Lihat Gallery
                            <x-lucide-arrow-right class="h-4 w-4" />
                        </button>
                    </div>
                </div>
            @endif
        @empty
            <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center">
                <x-lucide-images class="mx-auto h-10 w-10 text-gray-400" />

                <h2 class="mt-3 font-medium text-gray-900">
                    Belum ada gallery
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Gallery akan ditampilkan jika booking sudah memiliki data acara.
                </p>
            </div>
        @endforelse

        <div>
            {{ $transaksis->links('vendor.pagination.preline') }}
        </div>
    </div>

    {{-- Detail gallery --}}
    <div x-show="section === 'detail'" x-cloak>
        <div class="mb-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    @click="section = 'list'; transId = null"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50"
                >
                    <x-lucide-arrow-left class="h-5 w-5" />
                </button>

                <div>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Foto Acara
                    </h2>
                    <p class="text-sm text-gray-500">
                        Booking #<span x-text="transId"></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
            @foreach ($transaksis as $transaksi)
                @if ($transaksi->acara)
                    <div
                        x-show="transId === '{{ $transaksi->trans_id }}'"
                        x-cloak
                    >
                        <livewire:gallery-pinterest
                            :trans-id="$transaksi->trans_id"
                            :key="'gallery-'.$transaksi->trans_id"
                        />
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
