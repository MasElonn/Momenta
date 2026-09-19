<div x-data="{ section: '', acaraId: null }" x-show="tab === 'gallery'" class="space-y-6">
    <div x-show="section !== 'gallery'">
        <div class="flex flex-col my-3 mb-4">
            <span class="text-2xl font-semibold">My Gallery</span>
            <span class="text-gray-500">See All Your Completed Sessions</span>
        </div>

        <div class="space-y-4">
            @foreach($transaksis as $transaksi)
                @if($transaksi->acara)
                    @php($acara = $transaksi->acara)

                    <div @click="section = 'gallery'; acaraId = {{ $acara->acara_id }}"
                         class="mb-4 w-full rounded-lg border border-gray-200 shadow-sm p-4 cursor-pointer hover:border-gray-300 transition-colors">
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-1 class="w-5 h-5" />
                                <span class="font-semibold">Booking</span>
                                <span class="text-gray-400 text-sm">ID Booking:</span>
                                <span class="text-gray-500 text-sm">#{{ $acara->acara_id }}</span>
                            </div>
                            <span class="text-gray-400 text-sm">{{ $acara->tanggal->translatedFormat('d M Y') }}</span>
                        </div>

                        <div class="flex items-start gap-4">
                            <img class="rounded-lg w-25 h-25" src="https://picsum.photos/150/150" alt="gambar">

                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <h1 class="font-semibold text-lg">{{ $acara->judul }}</h1>
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                        {{ ucfirst($acara->status) }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-6 mt-2 text-sm text-gray-600">
                                    <span class="flex items-center gap-1">
                                        <x-lucide-circle-dollar-sign class="w-4 h-4 rounded-full" />
                                        Harga: Rp {{ number_format($transaksi->paket->harga ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <x-lucide-package-2 class="w-4 h-4 rounded-full" />
                                        Paket: {{ $transaksi->paket->judul ?? '-' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 mt-3">
                                    <x-lucide-user class="w-6 h-6 rounded-full" />
                                    <span class="text-sm text-gray-600">{{ $transaksi->paket->fotografer->name ?? '-' }} - Fotografer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{ $transaksis->links('vendor.pagination.preline') }}
    </div>

    <div x-show="section === 'gallery'">
        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div @click="section = ''"
                     class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full cursor-pointer hover:bg-gray-50 transition-colors">
                    <x-lucide-arrow-left class="w-6 h-6" />
                </div>

                <div class="flex flex-col">
                    <span class="flex-row text-xl font-semibold">My Gallery</span>
                    <span class="text-xs text-gray-400" x-text="'ID Booking: ' + acaraId"></span>
                </div>
            </div>
            <div class="mr-5">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                    Upcoming
                </span>
            </div>
        </div>

        <div class="mt-2 mb-3 flex justify-end gap-4 mr-5">
            <a :href="acaraId ? `/acara/${acaraId}/download` : '#'"
               class="py-2 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none">
                Download All
            </a>
        </div>

        <div class="max-h-screen overflow-y-auto pr-2">
            <livewire:gallery-pinterest/>
        </div>
    </div>
</div>
