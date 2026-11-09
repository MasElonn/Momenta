@props([
    'user' => Auth::user(),
    'totalPaket' => 0,
    'totalTransaksi' => 0,
    'totalBooking' => 0,
    'totalFoto' => 0,
    'totalPendapatan' => 0,
    'revenueLabels' => [],
    'revenueData' => [],
    'filterPeriode' => [],
    'rekapTransaksi' => [],
    'riwayatTransaksi' => collect(),
    'upcomingSessions' => collect(),
    'paketSaya' => collect(),
])

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
            Hello, {{ $user->name ?? 'Fotografer' }}!
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Welcome back to your Momenta dashboard. Your next photo session is about to begin.
        </p>
    </div>
    <div class="flex items-center gap-2.5">
        <button @click="tab = 'paket'; section = 'create'"
            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-xs transition">
            <x-lucide-plus class="w-4 h-4" />
            Tambah Paket
        </button>
        <button @click="tab = 'gallery'"
            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs sm:text-sm font-semibold rounded-xl shadow-xs transition">
            <x-lucide-upload class="w-4 h-4" />
            Upload Foto
        </button>
    </div>
</div>

<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-6">

    <div @click="tab = 'transaksi'; section = ''"
         class="bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-gray-200/80 cursor-pointer hover:shadow-md hover:border-gray-300 transition">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <x-lucide-wallet class="w-5 h-5" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-gray-500 font-medium truncate">Total Pendapatan</p>
                <h2 class="text-base sm:text-lg font-bold text-gray-900 whitespace-nowrap" title="Rp {{ number_format($totalPendapatan, 0, ',', '.') }}">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>
            </div>
        </div>
    </div>

    <div @click="tab = 'transaksi'; section = ''"
         class="bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-gray-200/80 cursor-pointer hover:shadow-md hover:border-gray-300 transition">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                <x-lucide-circle-dollar-sign class="w-5 h-5" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-gray-500 font-medium truncate">Total Transaksi</p>
                <h2 class="text-base sm:text-xl font-bold text-gray-900">{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>

    <div @click="tab = 'paket'; section = ''"
         class="bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-gray-200/80 cursor-pointer hover:shadow-md hover:border-gray-300 transition">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <x-lucide-package-2 class="w-5 h-5" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-gray-500 font-medium truncate">Total Paket</p>
                <h2 class="text-base sm:text-xl font-bold text-gray-900">{{ $totalPaket }}</h2>
            </div>
        </div>
    </div>

    <div @click="tab = 'booking'; section = ''"
         class="bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-gray-200/80 cursor-pointer hover:shadow-md hover:border-gray-300 transition">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                <x-lucide-calendar-1 class="w-5 h-5" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-gray-500 font-medium truncate">Booking Session</p>
                <h2 class="text-base sm:text-xl font-bold text-gray-900">{{ $totalBooking }}</h2>
            </div>
        </div>
    </div>

    <div @click="tab = 'gallery'; section = ''"
         class="bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-gray-200/80 cursor-pointer hover:shadow-md hover:border-gray-300 transition col-span-2 sm:col-span-1">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <x-lucide-image class="w-5 h-5" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-gray-500 font-medium truncate">Total Foto</p>
                <h2 class="text-base sm:text-xl font-bold text-gray-900">{{ $totalFoto }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-xl p-5 sm:p-6 shadow-xs border border-gray-200/80"
             x-data="revenueChartComponent()"
             x-init="$nextTick(() => initChart())"
             x-effect="if (tab === 'overview') { $nextTick(() => { if (!chart) { initChart(); } else { chart.resize(); } }); }">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4 pb-4 border-b border-gray-100">
                <div>
                    <h3 class="font-semibold text-gray-900">Grafik Pendapatan</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Pemasukan 6 bulan terakhir dari transaksi lunas (paid)</p>
                </div>
                <div class="sm:text-right">
                    <span class="text-[11px] text-gray-400 font-medium block">Total Akumulasi</span>
                    <p class="text-base sm:text-lg font-bold text-emerald-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="relative h-64 sm:h-72 w-full">
                <canvas x-ref="revenueCanvas"></canvas>
            </div>
        </div>

        <div x-data="{ periodeAktif: 'semua' }"
             class="bg-white border border-gray-200/80 rounded-xl shadow-xs overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <h3 class="font-semibold text-gray-900">
                        Transaksi Terbaru
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">
                        Riwayat pesanan & status pembayaran
                    </p>
                </div>

                <button @click="tab = 'transaksi'; section = ''"
                    class="text-xs font-medium text-blue-600 hover:text-blue-800 transition">
                    Lihat semua &rarr;
                </button>
            </div>

            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50/40">
                <div class="flex flex-wrap items-center gap-1.5">
                    @foreach ($filterPeriode as $key => $label)
                        <button
                            @click="periodeAktif = '{{ $key }}'"
                            :class="periodeAktif === '{{ $key }}'
                                ? 'bg-blue-600 text-white font-semibold shadow-xs'
                                : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                            class="px-3 py-1 rounded-lg text-xs transition flex items-center gap-1.5">
                            <span>{{ $label }}</span>
                            <span class="px-1.5 py-0.2 rounded-full text-[10px]"
                                  :class="periodeAktif === '{{ $key }}' ? 'bg-blue-800/40 text-white' : 'bg-gray-100 text-gray-500'">
                                {{ $rekapTransaksi[$key] }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50/75 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-5 py-3 font-medium">Order ID</th>
                            <th class="px-4 py-3 font-medium">Customer</th>
                            <th class="px-4 py-3 font-medium">Paket</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs sm:text-sm">
                        @forelse ($riwayatTransaksi as $transaksi)
                            @php
                                $status = strtolower($transaksi->status ?? '');
                                $statusClass = match ($status) {
                                    'paid' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'unpaid' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    'expired', 'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    default => 'bg-gray-100 text-gray-600 border-gray-200',
                                };
                            @endphp
                            <tr x-show="periodeAktif === 'semua' || periodeAktif === '{{ $transaksi->periode_filter }}'"
                                class="hover:bg-gray-50/70 transition">
                                <td class="px-5 py-3.5 font-semibold text-gray-900 whitespace-nowrap">
                                    {{ $transaksi->trans_id }}
                                </td>
                                <td class="px-4 py-3.5 text-gray-700 whitespace-nowrap">
                                    {{ $transaksi->customer->name ?? $transaksi->customer->nama ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-gray-600 whitespace-nowrap">
                                    {{ $transaksi->paket->judul ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-medium border {{ $statusClass }}">
                                        {{ ucfirst($status ?: 'Unknown') }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-500 whitespace-nowrap text-right">
                                    {{ $transaksi->created_at?->translatedFormat('d M Y') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-400">
                                    <x-lucide-receipt class="w-8 h-8 mx-auto mb-2 text-gray-300" />
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($riwayatTransaksi->isNotEmpty())
                    <div x-cloak
                         x-show="periodeAktif !== 'semua' && {{ json_encode($rekapTransaksi) }}[periodeAktif] === 0"
                         class="text-center py-8 text-gray-400 text-xs">
                        Tidak ada transaksi pada periode ini.
                    </div>
                @endif
            </div>
        </div>

    </div>

    <div class="space-y-6">

        <div class="bg-white border border-gray-200/80 rounded-xl shadow-xs overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <h3 class="font-semibold text-gray-900">
                        Upcoming Session
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">
                        Jadwal pemotretan terdekat
                    </p>
                </div>
                <button @click="tab = 'booking'; section = ''"
                    class="text-xs font-medium text-blue-600 hover:text-blue-800 transition">
                    Lihat semua &rarr;
                </button>
            </div>

            <div class="p-5 space-y-4">
                @forelse ($upcomingSessions as $session)
                    <div class="flex gap-3.5 items-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex flex-col items-center justify-center text-center shrink-0">
                            <span class="text-base font-bold text-blue-700 leading-none">
                                {{ \Carbon\Carbon::parse($session->tanggal)->format('d') }}
                            </span>
                            <span class="text-[10px] font-semibold text-blue-500 uppercase leading-tight mt-0.5">
                                {{ \Carbon\Carbon::parse($session->tanggal)->translatedFormat('M') }}
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="font-semibold text-sm text-gray-900 truncate" title="{{ $session->judul }}">
                                {{ $session->judul }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-0.5 truncate">
                                {{ $session->transaksi->customer->name ?? $session->transaksi->customer->nama ?? 'Customer' }}
                                @if ($session->jam)
                                    &bull; {{ $session->jam }} WIB
                                @endif
                            </p>
                            <div class="flex items-center gap-1.5 mt-1">
                                @if ($session->status == 'upcoming')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Akan Datang
                                    </span>
                                @elseif ($session->status == 'ongoing')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Berlangsung
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-gray-700 bg-gray-100 px-2 py-0.5 rounded-full">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        <x-lucide-calendar-days class="w-8 h-8 mx-auto text-gray-300 mb-2" />
                        <p class="text-xs text-gray-500">Belum ada booking mendatang.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white border border-gray-200/80 rounded-xl shadow-xs overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <h3 class="font-semibold text-gray-900">
                        Paket Saya
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $totalPaket }} paket terdaftar
                    </p>
                </div>
                <button @click="tab = 'paket'; section = ''"
                    class="text-xs font-medium text-blue-600 hover:text-blue-800 transition">
                    Kelola &rarr;
                </button>
            </div>

            <div class="p-5 space-y-3.5">
                @forelse ($paketSaya as $paket)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 shrink-0 rounded-xl bg-blue-50/80 border border-blue-100 flex items-center justify-center">
                            <x-lucide-camera class="w-5 h-5 text-blue-600" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate" title="{{ $paket->judul }}">
                                {{ $paket->judul }}
                            </p>
                            <p class="text-xs font-semibold text-emerald-600 mt-0.5">
                                Rp {{ number_format($paket->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full font-medium {{ $paket->tersedia ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                            {{ $paket->tersedia ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">
                        <x-lucide-package class="w-8 h-8 mx-auto text-gray-300 mb-2" />
                        <p class="text-xs text-gray-500">Belum ada paket fotografer.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

<script>
    function revenueChartComponent() {
        return {
            chart: null,
            initChart() {
                if (this.chart || !window.Chart) return;
                const canvas = this.$refs.revenueCanvas;
                if (!canvas) return;

                this.chart = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: @json($revenueLabels),
                        datasets: [{
                            label: 'Pendapatan',
                            data: @json($revenueData),
                            backgroundColor: 'rgba(37, 99, 235, 0.85)',
                            hoverBackgroundColor: 'rgba(29, 78, 216, 1)',
                            borderRadius: 8,
                            barThickness: 28,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => 'Rp ' + Number(ctx.raw || 0).toLocaleString('id-ID')
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: (val) => val >= 1000000 ? (val / 1000000) + 'jt' : (val >= 1000 ? (val / 1000) + 'rb' : val)
                                },
                                grid: { color: 'rgba(0, 0, 0, 0.04)' }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        };
    }
</script>
