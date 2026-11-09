<div
    x-show="tab === 'gallery'"
    x-cloak
    x-data="{
        section: 'list',
        transId: null
    }"
    class="space-y-6"
>
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Gallery
            </h1>
        </div>

        <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
            <x-lucide-images class="h-5 w-5 text-blue-600" />

            <span class="text-sm text-gray-600">
                Total acara
            </span>

            <span class="font-semibold text-gray-900">
                {{ $transaksis->total() }}
            </span>
        </div>
    </div>

    {{-- DAFTAR GALLERY --}}
    <div
        x-show="section === 'list'"
        class="w-full max-w-none grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5"
    >
        @forelse ($transaksis as $transaksi)

            @if ($transaksi->acara)

                @php
                    $jumlahFoto = \App\Models\Foto::where(
                        'acara_id',
                        $transaksi->acara->acara_id
                    )->count();

                    $status = $transaksi->acara->status;

                    $statusClass = match ($status) {
                        'upcoming' => 'bg-blue-50 text-blue-600',
                        'ongoing' => 'bg-amber-50 text-amber-600',
                        'completed' => 'bg-green-50 text-green-600',
                        default => 'bg-gray-100 text-gray-500',
                    };

                    $statusLabel = match ($status) {
                        'upcoming' => 'Akan Datang',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        default => 'Belum Ada Status',
                    };
                @endphp

                <div class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:border-blue-300 hover:shadow-md">

                    {{-- PREVIEW HEADER --}}
                    <div class="relative flex h-36 items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-gray-100">

                        <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-blue-100/60"></div>

                        <div class="absolute -bottom-12 -left-8 h-32 w-32 rounded-full bg-indigo-100/60"></div>

                        <div class="relative flex h-16 w-16 items-center justify-center rounded-2xl border border-white bg-white/80 shadow-sm">
                            <x-lucide-images class="h-8 w-8 text-blue-600" />
                        </div>

                        {{-- JUMLAH FOTO --}}
                        <div class="absolute bottom-3 right-3 flex items-center gap-1.5 rounded-full border border-white bg-white/90 px-3 py-1.5 shadow-sm">

                            <x-lucide-image class="h-3.5 w-3.5 text-blue-600" />

                            <span class="text-xs font-semibold text-gray-700">
                                {{ $jumlahFoto }} Foto
                            </span>

                        </div>
                    </div>

                    {{-- INFORMASI ACARA --}}
                    <div class="flex flex-1 flex-col p-4">

                        {{-- JUDUL --}}
                        <div class="min-w-0">
                            <h2 class="truncate font-semibold text-gray-900">
                                {{ $transaksi->acara->judul }}
                            </h2>
                        </div>

                        {{-- DETAIL UTAMA --}}
                        <div class="mt-4 grid grid-cols-3 gap-2 border-y border-gray-100 py-4">

                            {{-- CUSTOMER --}}
                            <div class="min-w-0">

                                <div class="mb-2 flex items-center gap-1.5 text-xs text-gray-400">
                                    <x-lucide-user class="h-4 w-4 shrink-0 text-blue-600" />
                                    Customer
                                </div>

                                <p
                                    class="truncate text-sm font-medium text-gray-700"
                                    title="{{ $transaksi->customer->nama ?? 'Customer' }}"
                                >
                                    {{ $transaksi->customer->nama ?? 'Customer' }}
                                </p>

                            </div>

                            {{-- PAKET --}}
                            <div class="min-w-0 border-x border-gray-100 px-3">

                                <div class="mb-2 flex items-center gap-1.5 text-xs text-gray-400">
                                    <x-lucide-package class="h-4 w-4 shrink-0 text-blue-600" />
                                    Paket
                                </div>

                                <p
                                    class="truncate text-sm font-medium text-gray-700"
                                    title="{{ $transaksi->paket->judul ?? '-' }}"
                                >
                                    {{ $transaksi->paket->judul ?? '-' }}
                                </p>

                            </div>

                            {{-- TANGGAL --}}
                            <div class="min-w-0 text-right">

                                <div class="mb-2 flex items-center justify-end gap-1.5 text-xs text-gray-400">
                                    Tanggal
                                    <x-lucide-calendar class="h-4 w-4 shrink-0 text-blue-600" />
                                </div>

                                <p class="whitespace-nowrap text-sm font-medium text-gray-700">
                                    {{ $transaksi->acara->tanggal?->translatedFormat('d M Y') ?? '-' }}
                                </p>

                            </div>

                        </div>

                        {{-- LOKASI DAN STATUS --}}
                        <div class="flex items-center justify-between gap-3 py-3">

                            {{-- LOKASI --}}
                            <div class="flex min-w-0 items-center gap-2">

                                <x-lucide-map-pin class="h-4 w-4 shrink-0 text-blue-600" />

                                <span
                                    class="truncate text-sm text-gray-500"
                                    title="{{ $transaksi->acara->lokasi ?? '-' }}"
                                >
                                    {{ $transaksi->acara->lokasi ?? 'Lokasi belum ditentukan' }}
                                </span>

                            </div>

                            {{-- STATUS --}}
                            <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>

                        </div>

                        {{-- TOMBOL KELOLA GALLERY --}}
                        <div class="mt-auto border-t border-gray-100 pt-4">

                            <button
                                type="button"
                                @click="section = 'detail'; transId = @js((string) $transaksi->trans_id)"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
                            >
                                <x-lucide-images class="h-4 w-4" />

                                Kelola Gallery

                                <x-lucide-arrow-right class="h-4 w-4" />
                            </button>

                        </div>

                    </div>
                </div>

            @endif

        @empty

            {{-- EMPTY STATE --}}
            <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center md:col-span-2 xl:col-span-4">

                <x-lucide-images class="mx-auto h-10 w-10 text-gray-400" />

                <h2 class="mt-3 font-medium text-gray-900">
                    Belum ada gallery
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Gallery acara yang tersedia akan muncul di sini.
                </p>

            </div>

        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div
        x-show="section === 'list'"
        class="flex justify-center pt-4"
    >
        @if ($transaksis->hasPages())
            {{ $transaksis->onEachSide(1)->links('vendor.pagination.preline') }}
        @endif
    </div>

    {{-- DETAIL GALLERY --}}
    <div x-show="section === 'detail'" x-cloak>

        {{-- HEADER DETAIL --}}
        <div class="mb-5 flex items-center gap-3">

            <button
                type="button"
                @click="section = 'list'; transId = null"
                class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white transition hover:bg-gray-50"
            >
                <x-lucide-arrow-left class="h-5 w-5" />
            </button>

            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Gallery Acara
                </h2>
            </div>

        </div>

        {{-- KONTEN GALLERY --}}
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:p-6">

            @foreach ($transaksis as $transaksi)

                @if ($transaksi->acara)

                    <div
                        x-show="transId === @js((string) $transaksi->trans_id)"
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