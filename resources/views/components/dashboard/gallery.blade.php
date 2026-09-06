<div x-show="tab === 'gallery'" x-data="{ modalOpen: false, selectedImage: null }" class="space-y-6">
    <div :class="section === 'gallery' ? 'hidden' : ''">
        <div class="flex flex-col my-3 mb-4">
            <span class="text-2xl font-semibold">My Gallery</span>
            <span class="text-gray-500">See All Your Completed Sessions</span>
        </div>

        @foreach(\App\Models\Transaksi::with('acara', 'paket')->where('customer_id', Auth::id())->get() as $transaksi)
            @if($transaksi->acara)
                @php($acara = $transaksi->acara)

                <div @click="section = 'gallery'"
                     :class="section === 'gallery' ? 'hidden': ''"
                     class="w-full rounded-lg border border-gray-200 shadow-sm p-4 cursor-pointer">
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
            </div>
    @endif
    @endforeach
    <div x-show="section === 'gallery'">
        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div @click="section = ''"
                     class="border border-gray-200 flex items-center justify-center shadow w-12 h-12 rounded-full cursor-pointer">
                    <x-lucide-arrow-left class="w-6 h-6" />
                </div>

                <div class="flex flex-col">
                    <span class="flex-row text-xl font-semibold">My Gallery</span>
                    <span class="text-xs text-gray-400">ID Booking: 1234567</span>
                </div>
            </div>
            <div class="mr-5">
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                    Upcoming
                </span>
            </div>
        </div>

        <div class="mt-2 mb-3 flex justify-end gap-4 mr-5">
            <button type="button" class="py-2 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-focus disabled:opacity-50 disabled:pointer-events-none">
                Download All
            </button>
        </div>

        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <img src="https://picsum.photos/400/600?random=1" alt="Session Photo" loading="lazy" class="w-full h-auto object-cover block">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-end gap-2">
                        <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-download class="w-4 h-4" />
                        </button>
                        <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-trash-2 class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="flex items-center justify-end text-white">
                        <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/800/1200?random=1'"
                                class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                            View
                        </button>
                    </div>
                </div>
            </div>

            <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <img src="https://picsum.photos/400/300?random=2" alt="Session Photo" loading="lazy" class="w-full h-auto object-cover block">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-end gap-2">
                        <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-download class="w-4 h-4" />
                        </button>
                        <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-trash-2 class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="flex items-center justify-end text-white">
                        <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/1200/800?random=2'"
                                class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                            View
                        </button>
                    </div>
                </div>
            </div>

            <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <img src="https://picsum.photos/400/500?random=3" alt="Session Photo" loading="lazy" class="w-full h-auto object-cover block">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-end gap-2">
                        <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-download class="w-4 h-4" />
                        </button>
                        <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-trash-2 class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="flex items-center justify-end text-white">
                        <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/800/1000?random=3'"
                                class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                            View
                        </button>
                    </div>
                </div>
            </div>

            <div class="break-inside-avoid relative group rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <img src="https://picsum.photos/400/700?random=4" alt="Session Photo" loading="lazy" class="w-full h-auto object-cover block">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 p-4 flex flex-col justify-between">
                    <div class="flex justify-end gap-2">
                        <button class="p-2 bg-white/80 hover:bg-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-download class="w-4 h-4" />
                        </button>
                        <button class="p-2 bg-white/80 hover:bg-red-500 hover:text-white rounded-full text-gray-700 transition-colors shadow">
                            <x-lucide-trash-2 class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="flex items-center justify-end text-white">
                        <button @click="modalOpen = true; selectedImage = 'https://picsum.photos/800/1400?random=4'"
                                class="text-xs bg-white text-gray-800 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors shadow">
                            View
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="modalOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
             x-cloak>
            <div @click.away="modalOpen = false" class="relative max-w-4xl max-h-[90vh] bg-white rounded-2xl overflow-hidden shadow-2xl flex flex-col">
                <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 p-2 bg-black/50 hover:bg-black/70 text-white rounded-full transition-colors">
                    <x-lucide-x class="w-5 h-5" />
                </button>

                <div class="overflow-auto max-h-[85vh]">
                    <img :src="selectedImage" alt="Expanded view" class="w-full h-auto object-contain">
                </div>
            </div>
        </div>
    </div>
</div>
