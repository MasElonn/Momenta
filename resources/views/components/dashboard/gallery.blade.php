<div x-show="tab === 'gallery'" class="space-y-6">
    <div x-show="!section">
        <div class="flex flex-col my-3 mb-4">
            <span class="text-2xl font-semibold">My Gallery</span>
            <span class="text-gray-500">See All Your Completed Sessions</span>
        </div>

        <div class="space-y-4">
            @forelse($transaksis as $transaksi)
                @if($transaksi->acara)
                    @php
                        $acara = $transaksi->acara;
                    @endphp

                    <div @click="section = 'gallery-{{ $acara->acara_id }}'"
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
                            <img class="rounded-lg w-25 h-25 object-cover" loading="lazy" src="{{ $acara->foto->first()?->thumbnail_url ?? 'https://placehold.co/100/2C5CF3/white?text='.ucfirst(substr($acara->judul,0,1)).'&font=poppins' }}" alt="gambar">

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
            @empty
                <div class="text-sm text-gray-400 py-4">Belum ada gallery.</div>
            @endforelse
        </div>
        {{ $transaksis->links('vendor.pagination.preline') }}
    </div>

    @foreach($transaksis as $transaksi)
        @if($transaksi->acara)
            @php $acara = $transaksi->acara; @endphp

            <div x-show="section === 'gallery-{{ $acara->acara_id }}'">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <div @click="section = ''"
                             class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full cursor-pointer hover:bg-gray-50 transition-colors">
                            <x-lucide-arrow-left class="w-6 h-6" />
                        </div>

                        <div class="flex flex-col">
                            <span class="flex-row text-xl font-semibold">My Gallery</span>
                            <span class="text-xs text-gray-400">ID Booking: #{{ $acara->acara_id }}</span>
                        </div>
                    </div>
                    <div class="mr-5">
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                            {{ ucfirst($acara->status) }}
                        </span>
                    </div>
                </div>

                <div class="mt-2 mb-3 flex justify-end gap-4 mr-5">
                    <a href="{{ route('foto.downloadAll', ['acaraId' => $acara->acara_id]) }}"
                       class="py-2 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none">
                        Download All
                    </a>
                </div>

                <div class="max-h-screen overflow-y-auto pr-2">
                    <livewire:gallery-pinterest :acara-id="$acara->acara_id" :wire:key="'gallery-'.$acara->acara_id" />
                </div>
            </div>
        @endif
    @endforeach
</div>
