<div x-show="tab === 'booking'" x-cloak>

    <div class="my-4">
        <h1 class="text-2xl font-semibold">Daftar Booking</h1>
        <p class="text-gray-500">Booking pelanggan yang menggunakan paket Anda</p>
    </div>

    @php
        $booking = \App\Models\Transaksi::with(['customer', 'paket', 'acara'])
            ->whereHas('paket', function ($query) {
                $query->where('fotografer_id', Auth::id());
            })
            ->get();
    @endphp

    @if($booking->count() > 0)

        <div class="bg-white rounded-lg border overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Customer</th>
                        <th class="text-left p-3">Paket</th>
                        <th class="text-left p-3">Tanggal</th>
                        <th class="text-left p-3">Jam</th>
                        <th class="text-left p-3">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($booking as $transaksi)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $transaksi->customer->name ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $transaksi->paket->judul ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $transaksi->acara?->tanggal?->format('d-m-Y') ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $transaksi->acara->jam ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ ucfirst($transaksi->acara->status ?? '-') }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    @else

        <div class="border rounded-lg p-6 text-center">
            <p class="text-gray-500">Belum ada booking.</p>
        </div>

    @endif

</div>