
@props(['user' => Auth::user(), 'transaksis'])

@php
    $fotograferId = auth()->id();

    $totalPaket = \App\Models\Paket::where('fotografer_id', $fotograferId)->count();

    $totalTransaksi = \App\Models\Transaksi::whereHas('paket', function ($query) use ($fotograferId) {
        $query->where('fotografer_id', $fotograferId);
    })->count();

    $totalBooking = \App\Models\Acara::whereHas('transaksi.paket', function ($query) use ($fotograferId) {
        $query->where('fotografer_id', $fotograferId);
    })->whereDate('tanggal', '>=', now()->toDateString())->count();

    $totalFoto = \App\Models\Foto::whereHas('acara.transaksi.paket', function ($query) use ($fotograferId) {
        $query->where('fotografer_id', $fotograferId);
    })->count();
@endphp

<div>
    <h1 class="pt-5 text-4xl font-semibold">
        Hello, {{ $user->name ?? Auth::user()->name }}!
    </h1>

    <h2>Welcome back to your Momenta dashboard. Your next photo session is about to begin.</h2>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mt-6 mb-6">

        {{-- Total Paket --}}
        <div @click="tab = 'paket'; section = ''"
             class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <x-lucide-package-2 class="w-6 h-6 text-blue-600" />
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Paket</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $totalPaket }}</h2>
                </div>
            </div>
        </div>

        {{-- Total Transaksi --}}
        <div @click="tab = 'transaksi'; section = ''"
             class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                    <x-lucide-circle-dollar-sign class="w-6 h-6 text-green-600" />
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Transaksi</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $totalTransaksi }}</h2>
                </div>
            </div>
        </div>

        {{-- Booking Session --}}
        <div @click="tab = 'booking'; section = ''"
             class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center">
                    <x-lucide-calendar-1 class="w-6 h-6 text-orange-600" />
                </div>
                <div>
                    <p class="text-sm text-gray-500">Booking Session</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $totalBooking }}</h2>
                </div>
            </div>
        </div>

        {{-- Total Foto --}}
        <div @click="tab = 'gallery'; section = ''"
             class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                    <x-lucide-image class="w-6 h-6 text-purple-600" />
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Foto</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $totalFoto }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
        <div>
            <right>
                upcoming sessions
            </right>
        </div>