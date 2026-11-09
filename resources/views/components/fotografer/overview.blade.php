@props(['user' => Auth::user(), 'transaksis' => collect()])

@php
    $fotograferId = auth()->id();

    // Query dasar transaksi fotografer
    $queryTransaksi = \App\Models\Transaksi::whereHas('paket', function ($query) use ($fotograferId) {
        $query->where('fotografer_id', $fotograferId);
    });

    // Statistik
    $totalPaket = \App\Models\Paket::where('fotografer_id', $fotograferId)->count();

    $totalTransaksi = (clone $queryTransaksi)->count();

    $totalBooking = \App\Models\Acara::whereHas('transaksi.paket', function ($query) use ($fotograferId) {
        $query->where('fotografer_id', $fotograferId);
    })->whereDate('tanggal', '>=', now()->toDateString())->count();

    $totalFoto = \App\Models\Foto::whereHas('acara.transaksi.paket', function ($query) use ($fotograferId) {
        $query->where('fotografer_id', $fotograferId);
    })->count();

    // Rentang tanggal filter
    $rentangPeriode = [
        '7_hari' => [
            now()->copy()->subDays(6)->startOfDay(),
            now()->copy()->endOfDay()
        ],
        '2_minggu' => [
            now()->copy()->subDays(13)->startOfDay(),
            now()->copy()->subDays(7)->endOfDay()
        ],
        '3_minggu' => [
            now()->copy()->subDays(20)->startOfDay(),
            now()->copy()->subDays(14)->endOfDay()
        ],
        'bulan_1' => [
            now()->copy()->subMonthNoOverflow()->startOfMonth(),
            now()->copy()->subMonthNoOverflow()->endOfMonth()
        ],
        'bulan_2' => [
            now()->copy()->subMonthsNoOverflow(2)->startOfMonth(),
            now()->copy()->subMonthsNoOverflow(2)->endOfMonth()
        ],
        'bulan_3' => [
            now()->copy()->subMonthsNoOverflow(3)->startOfMonth(),
            now()->copy()->subMonthsNoOverflow(3)->endOfMonth()
        ],
    ];

    // Label periode
    $filterPeriode = [
        'semua' => 'Semua',
        '7_hari' => '7 Hari Terakhir',
        '2_minggu' => '2 Minggu Lalu',
        '3_minggu' => '3 Minggu Lalu',
        'bulan_1' => 'Bulan Lalu',
        'bulan_2' => '2 Bulan Lalu',
        'bulan_3' => '3 Bulan Lalu',
    ];

    // Jumlah transaksi setiap periode
    $rekapTransaksi = [
        'semua' => (clone $queryTransaksi)->count()
    ];

    foreach ($rentangPeriode as $key => $rentang) {
        $rekapTransaksi[$key] = (clone $queryTransaksi)
            ->whereBetween('created_at', $rentang)
            ->count();
    }

    // Semua transaksi untuk filter
    $riwayatTransaksi = (clone $queryTransaksi)
        ->with(['customer', 'paket'])
        ->latest()
        ->get();

    // Menentukan periode setiap transaksi
    foreach ($riwayatTransaksi as $transaksi) {
        $transaksi->periode_filter = 'lainnya';

        if ($transaksi->created_at) {
            foreach ($rentangPeriode as $key => $rentang) {
                if ($transaksi->created_at->between($rentang[0], $rentang[1])) {
                    $transaksi->periode_filter = $key;
                    break;
                }
            }
        }
    }

    // Upcoming Session
    $upcomingSessions = \App\Models\Acara::with(['transaksi.customer', 'transaksi.paket'])
        ->whereHas('transaksi.paket', function ($query) use ($fotograferId) {
            $query->where('fotografer_id', $fotograferId);
        })
        ->whereDate('tanggal', '>=', now()->toDateString())
        ->orderBy('tanggal')
        ->take(4)
        ->get();

    // Paket fotografer
    $paketSaya = \App\Models\Paket::where('fotografer_id', $fotograferId)
        ->latest()
        ->take(4)
        ->get();
@endphp


{{-- HEADER DAN STATISTIK --}}
<div>

    <h1 class="pt-5 text-4xl font-semibold">
        Hello, {{ $user->name ?? 'Fotografer' }}!
    </h1>

    <h2 class="text-gray-500 mt-2">
        Welcome back to your Momenta dashboard. Your next photo session is about to begin.
    </h2>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mt-6 mb-6">

        {{-- TOTAL PAKET --}}
        <div @click="tab = 'paket'; section = ''"
            class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition">

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

        {{-- TOTAL TRANSAKSI --}}
        <div @click="tab = 'transaksi'; section = ''"
            class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition">

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

        {{-- BOOKING SESSION --}}
        <div @click="tab = 'booking'; section = ''"
            class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition">

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

        {{-- TOTAL FOTO --}}
        <div @click="tab = 'gallery'; section = ''"
            class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 cursor-pointer hover:shadow-md transition">

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


{{-- OVERVIEW CONTENT --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

    {{-- KOLOM KIRI --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- TRANSAKSI TERBARU --}}
        <div x-data="{ periodeAktif: 'semua' }"
            class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">

            <div class="flex items-center justify-between px-5 py-4">

                <div>
                    <h3 class="font-semibold text-gray-800">
                        Transaksi Terbaru
                    </h3>

                    <p class="text-xs text-gray-400 mt-1">
                        Riwayat transaksi fotografer
                    </p>
                </div>

                <button @click="tab = 'transaksi'; section = ''"
                    class="text-sm text-blue-600 hover:text-blue-800">
                    Lihat semua
                </button>

            </div>

            {{-- FILTER PERIODE --}}
            <div class="overflow-x-auto px-4">
                <div class="flex items-center gap-6 min-w-max border-b border-gray-200">

                    @foreach ($filterPeriode as $key => $label)

                        <button
                            @click="periodeAktif = '{{ $key }}'"
                            :class="periodeAktif === '{{ $key }}'
                                ? 'text-blue-600 border-b-2 border-blue-600 font-semibold'
                                : 'text-gray-500 hover:text-gray-800 border-b-2 border-transparent'"
                            class="py-3 text-sm whitespace-nowrap transition">

                            {{ $label }}

                            <span class="ml-1 text-xs">
                                ({{ $rekapTransaksi[$key] }})
                            </span>

                        </button>

                    @endforeach

                </div>
            </div>

            {{-- TABEL TRANSAKSI --}}
            <div class="overflow-x-auto px-4 pb-4">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="px-3 py-3 font-medium">Order ID</th>
                            <th class="px-3 py-3 font-medium">Customer</th>
                            <th class="px-3 py-3 font-medium">Paket</th>
                            <th class="px-3 py-3 font-medium">Status</th>
                            <th class="px-3 py-3 font-medium">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($riwayatTransaksi as $transaksi)

                            @php
                                $status = strtolower($transaksi->status ?? '');

                                $statusClass = match ($status) {
                                    'paid' => 'bg-green-100 text-green-700',
                                    'pending', 'unpaid' => 'bg-yellow-100 text-yellow-700',
                                    'expired', 'rejected' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp

                            <tr
                                x-show="periodeAktif === 'semua' || periodeAktif === '{{ $transaksi->periode_filter }}'"
                                class="hover:bg-gray-50">

                                <td class="px-3 py-3 font-medium text-gray-700 whitespace-nowrap">
                                    {{ $transaksi->trans_id }}
                                </td>

                                <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                                    {{ $transaksi->customer->name ?? $transaksi->customer->nama ?? '-' }}
                                </td>

                                <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                                    {{ $transaksi->paket->judul ?? '-' }}
                                </td>

                                <td class="px-3 py-3">
                                    <span class="px-2 py-1 rounded-md text-xs font-medium {{ $statusClass }}">
                                        {{ ucfirst($status ?: 'Unknown') }}
                                    </span>
                                </td>

                                <td class="px-3 py-3 text-gray-500 whitespace-nowrap">
                                    {{ $transaksi->created_at?->format('d M Y') ?? '-' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-400">
                                    <x-lucide-receipt class="w-9 h-9 mx-auto mb-2" />
                                    Belum ada transaksi.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

                {{-- PESAN PERIODE KOSONG --}}
                @if ($riwayatTransaksi->isNotEmpty())
                    <div
                        x-cloak
                        x-show="
                            periodeAktif !== 'semua' &&
                            {{ json_encode($rekapTransaksi) }}[periodeAktif] === 0
                        "
                        class="text-center py-8 text-gray-400 text-sm">

                        Tidak ada transaksi pada periode ini.

                    </div>
                @endif

            </div>

        </div>

    </div>


    {{-- KOLOM KANAN --}}
    <div class="space-y-5">

        {{-- UPCOMING SESSION --}}
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800 text-center">
                    Upcoming Session
                </h3>
            </div>

            <div class="p-4 space-y-5">

                @forelse ($upcomingSessions as $session)

                    <div class="flex gap-4 items-center">

                        <div class="w-12 shrink-0 text-center border-r border-gray-200 pr-3">

                            <p class="text-2xl font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($session->tanggal)->format('d') }}
                            </p>

                            <p class="text-xs text-gray-500 uppercase">
                                {{ \Carbon\Carbon::parse($session->tanggal)->translatedFormat('M') }}
                            </p>

                        </div>

                        <div class="min-w-0 flex-1">

                            <h4 class="font-semibold text-sm text-gray-800 truncate">
                                {{ $session->judul }}
                            </h4>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ $session->transaksi->customer->name ?? $session->transaksi->customer->nama ?? 'Customer' }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ $session->jam ?? 'Jadwal belum ditentukan' }}
                                @if ($session->jam)
                                    WIB
                                @endif
                            </p>

                            <div class="flex items-center gap-1 mt-2">

                                @if ($session->status == 'upcoming')
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    <span class="text-xs text-green-600">Upcoming</span>

                                @elseif ($session->status == 'ongoing')
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    <span class="text-xs text-blue-600">Ongoing</span>

                                @else
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    <span class="text-xs text-yellow-600">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-8">

                        <x-lucide-calendar-days class="w-10 h-10 mx-auto text-gray-300 mb-2" />

                        <p class="text-sm text-gray-500">
                            Belum ada booking mendatang.
                        </p>

                    </div>

                @endforelse

            </div>

            <div class="px-4 pb-4">

                <button @click="tab = 'booking'; section = ''"
                    class="text-sm text-blue-600 hover:text-blue-800">
                    Lihat semua
                </button>

            </div>

        </div>


        {{-- PAKET SAYA --}}
        <div @click="tab = 'paket'; section = ''"
            class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden cursor-pointer hover:shadow-md transition">

            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-100">

                <h3 class="font-semibold text-gray-800">
                    Paket Saya
                </h3>

                <span class="text-xs text-blue-600">
                    {{ $totalPaket }} Paket
                </span>

            </div>

            <div class="p-4 space-y-3">

                @forelse ($paketSaya as $paket)

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 shrink-0 rounded-lg bg-blue-50 flex items-center justify-center">
                            <x-lucide-camera class="w-5 h-5 text-blue-600" />
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="text-sm font-semibold text-gray-800 truncate">
                                {{ $paket->judul }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Rp {{ number_format($paket->harga, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <x-lucide-package class="w-8 h-8 mx-auto text-gray-300 mb-2" />

                        <p class="text-sm text-gray-500">
                            Belum ada paket fotografer.
                        </p>

                    </div>

                @endforelse

            </div>

            <div class="px-4 py-3 border-t border-gray-100 text-xs text-blue-600">
                Lihat semua
            </div>

        </div>

    </div>

</div>