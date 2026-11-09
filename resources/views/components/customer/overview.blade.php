@props(['user' => Auth::user(), 'transaksis'])

<div x-show="tab === 'overview'">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Hello, {{ $user->name ?? Auth::user()->name }}!</h1>
            <p class="text-sm text-gray-500 mt-1">Welcome back to your Momenta dashboard. Your next session is coming up soon.</p>
        </div>
        <a href="{{ route('fotografer.browse') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-xs transition shrink-0">
            <x-lucide-camera class="w-4 h-4" />
            Cari Fotografer
        </a>
    </div>

    <div class="mt-5 flex justify-between">
        <div class="flex-auto w-full p-2">
            <h2 class="py-2 text-xl font-semibold">Bookings</h2>

            @forelse($transaksis as $transaksi)
                @if($transaksi->acara)
                    @php $acara = $transaksi->acara; @endphp

                    <div class="w-full rounded-lg border border-gray-200 shadow-sm p-4 mb-4">
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <x-lucide-calendar-1 class="w-5 h-5" />
                                <span class="font-semibold">Booking</span>
                                <span class="text-gray-400 text-sm">ID Booking:</span>
                                <span class="text-gray-500 text-sm">#{{ $transaksi->trans_id }}</span>
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

                                <div class="flex justify-between mt-3">
                                    <div class="flex gap-1">
                                        <x-lucide-user class="w-6 h-6 rounded-full" />
                                        <span class="text-sm text-gray-600">{{ $transaksi->paket->fotografer->name ?? '-' }} - Fotografer</span>
                                    </div>

                                    <div class="flex gap-2">
                                        <button type="button" @click="section = 'booking-{{$acara->acara_id}}', tab = 'booking'"
                                                class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                            Manage
                                        </button>

                                        <button type="button" @click="section = 'gallery-{{$acara->acara_id}}', tab = 'gallery'"
                                                class="py-1.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                                            Gallery
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="rounded-xl border border-dashed border-gray-300 p-8 text-center bg-white my-4">
                    <x-lucide-calendar-days class="w-10 h-10 mx-auto text-gray-300 mb-2" />
                    <p class="text-sm font-medium text-gray-700">Belum ada booking sesi</p>
                    <p class="text-xs text-gray-400 mt-1 mb-4">Temukan fotografer sekolah terbaik untuk mengabadikan momen acaramu.</p>
                    <a href="{{ route('fotografer.browse') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-xs transition">
                        <x-lucide-camera class="w-3.5 h-3.5" />
                        Cari Fotografer Sekarang
                    </a>
                </div>
            @endforelse
            {{$transaksis->links('vendor.pagination.preline')}}
        </div>

        <div class="w-70 flex-auto p-2">
            <h2 class="py-2 text-xl font-semibold">Gallery</h2>
            @php
                $recentFotos = $transaksis->pluck('acara.foto')->flatten()->filter()->take(3);
            @endphp
            @if ($recentFotos->isNotEmpty())
                @foreach ($recentFotos as $foto)
                    <div class="mt-2 shadow w-full h-40  rounded-lg overflow-hidden"
                         @click="section = 'gallery-{{ $foto->acara_id }}', tab = 'gallery'">
                        <img loading="lazy" class="rounded-lg w-full h-full object-cover" src="{{ $foto->thumbnail_url ?? $foto->r2_url }}" alt="foto">
                    </div>
                @endforeach
            @else
                <div class="text-sm text-gray-400 py-4">Belum ada foto.</div>
            @endif
        </div>
    </div>
</div>