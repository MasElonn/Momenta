<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Invoice #{{ $transaksi->trans_id }} - Momenta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .invoice-card {
                border: none !important;
                box-shadow: none !important;
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased min-h-screen py-6 px-4 sm:px-6">

    <div class="max-w-3xl mx-auto mb-4 flex items-center justify-between no-print">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
            <x-lucide-arrow-left class="w-4 h-4" />
            Kembali ke Dashboard
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow-sm transition-colors">
            <x-lucide-printer class="w-4 h-4" />
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="invoice-card max-w-3xl mx-auto bg-white border border-gray-200 rounded-2xl p-6 sm:p-10 shadow-sm">
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-gray-200 gap-4">
            <div>
                <img src="{{ asset('images/Logo.svg') }}" alt="Momenta" class="h-10 w-auto">
                <p class="text-xs text-gray-400 mt-1.5">Platform Booking & Galeri Fotografi Acara Sekolah</p>
            </div>
            <div class="sm:text-right">
                <span class="text-xs uppercase tracking-wider text-gray-400 font-semibold block">Bukti Transaksi / Invoice</span>
                <span class="text-base font-bold text-gray-900">#{{ $transaksi->trans_id }}</span>
                <div class="mt-1">
                    @if($transaksi->status === 'paid')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                            Lunas / Berhasil
                        </span>
                    @elseif($transaksi->status === 'pending')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                            Menunggu Verifikasi
                        </span>
                    @elseif($transaksi->status === 'rejected')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                            Ditolak
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 py-6 border-b border-gray-200 text-sm">
            <div>
                <h4 class="text-xs font-semibold uppercase text-gray-400 mb-2">Informasi Customer</h4>
                <p class="font-bold text-gray-900">{{ $transaksi->customer->name ?? '-' }}</p>
                <p class="text-gray-600">{{ $transaksi->customer->email ?? '-' }}</p>
                <p class="text-gray-600">{{ $transaksi->customer->no_hp ?? 'No. HP belum diisi' }}</p>
            </div>
            <div class="sm:text-right">
                <h4 class="text-xs font-semibold uppercase text-gray-400 mb-2">Informasi Fotografer</h4>
                <p class="font-bold text-gray-900">{{ $transaksi->paket?->fotografer?->name ?? '-' }}</p>
                <p class="text-gray-600">{{ $transaksi->paket?->fotografer?->email ?? '-' }}</p>
                <p class="text-gray-600">{{ $transaksi->paket?->fotografer?->no_hp ?? '-' }}</p>
            </div>
        </div>

        @if($transaksi->acara)
            <div class="py-6 border-b border-gray-200 text-sm">
                <h4 class="text-xs font-semibold uppercase text-gray-400 mb-3">Detail Sesi Pemotretan</h4>
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-3 gap-3 border border-gray-100">
                    <div>
                        <span class="text-xs text-gray-500 block">Acara</span>
                        <span class="font-semibold text-gray-800">{{ $transaksi->acara->judul }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 block">Jadwal</span>
                        <span class="font-semibold text-gray-800">
                            {{ $transaksi->acara->tanggal?->translatedFormat('d M Y') ?? '-' }}, {{ $transaksi->acara->jam ?? '-' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 block">Lokasi Pertemuan</span>
                        <span class="font-semibold text-gray-800 break-words">{{ $transaksi->acara->lokasi }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="py-6 border-b border-gray-200">
            <h4 class="text-xs font-semibold uppercase text-gray-400 mb-3">Rincian Paket & Pembayaran</h4>
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500 text-xs uppercase">
                        <th class="pb-2 font-medium">Paket</th>
                        <th class="pb-2 font-medium hidden sm:table-cell">Detail</th>
                        <th class="pb-2 text-right font-medium">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-3">
                            <span class="font-bold text-gray-900 block">{{ $transaksi->paket?->judul ?? 'Paket Foto' }}</span>
                            <span class="text-xs text-gray-500 sm:hidden">
                                {{ $transaksi->paket?->durasi ?? '-' }} • {{ $transaksi->paket?->jumlah_foto ?? '-' }} foto
                            </span>
                        </td>
                        <td class="py-3 text-gray-600 hidden sm:table-cell text-xs">
                            {{ $transaksi->paket?->durasi ?? '-' }} sesi • {{ $transaksi->paket?->jumlah_foto ?? '-' }} hasil foto
                        </td>
                        <td class="py-3 text-right font-semibold text-gray-900">
                            Rp {{ number_format($transaksi->paket?->harga ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-gray-200">
                        <td colspan="2" class="pt-4 font-bold text-base text-gray-900">Total Pembayaran</td>
                        <td class="pt-4 text-right font-bold text-xl text-blue-600">
                            Rp {{ number_format($transaksi->paket?->harga ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between text-xs text-gray-500 gap-3">
            <div>
                <p>Waktu Pemesanan: <span class="font-medium text-gray-700">{{ $transaksi->created_at ? \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d M Y, H:i') : '-' }}</span></p>
                @if($transaksi->paid_at)
                    <p>Waktu Pembayaran: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($transaksi->paid_at)->translatedFormat('d M Y, H:i') }}</span></p>
                @endif
                @if($transaksi->verified_at)
                    <p>Diverifikasi pada: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($transaksi->verified_at)->translatedFormat('d M Y, H:i') }}</span></p>
                @endif
            </div>
            <div class="sm:text-right">
                <p class="text-gray-400">Struk resmi diterbitkan otomatis oleh Momenta.</p>
                <p class="text-gray-400">Simpan bukti ini sebagai konfirmasi pemesanan Anda.</p>
            </div>
        </div>

    </div>

</body>
</html>
