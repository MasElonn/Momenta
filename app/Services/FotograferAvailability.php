<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Single source of truth for "is this fotografer busy at that time?".
 *
 * Used by AvailabilityController (the Cek Ketersediaan page) and by
 * TransaksiController::create() (the actual booking), so the page can never
 * say "available" for a slot the booking step would then reject.
 */
class FotograferAvailability
{
    /**
     * Transaksi statuses that hold a slot. 'rejected' and 'expired' never
     * went through, so they don't block anyone.
     */
    private const BLOCKING_STATUSES = ['unpaid', 'pending', 'paid'];

    /**
     * IDs of every fotografer with a booking overlapping the given window.
     *
     * @return list<int>
     */
    public function busyFotograferIds(string $tanggal, string $mulai, string $selesai): array
    {
        return $this->overlappingBookings($tanggal, $mulai, $selesai)
            ->pluck('fotografer_id')
            ->unique()
            ->values()
            ->all();
    }

    public function isFree(int $fotograferId, string $tanggal, string $mulai, string $selesai): bool
    {
        return ! in_array(
            $fotograferId,
            $this->busyFotograferIds($tanggal, $mulai, $selesai),
            true
        );
    }

    private function overlappingBookings(string $tanggal, string $mulai, string $selesai)
    {
        return DB::table('acara')
            ->join('transaksi', 'acara.trans_id', '=', 'transaksi.trans_id')
            ->join('paket', 'transaksi.paket_id', '=', 'paket.paket_id')
            ->whereDate('acara.tanggal', $tanggal)
            ->whereIn('transaksi.status', self::BLOCKING_STATUSES)
            ->select('acara.jam', 'acara.jam_selesai', 'paket.fotografer_id')
            ->get()
            ->filter(function ($booking) use ($mulai, $selesai) {
                $bookingMulai = substr($booking->jam, 0, 5);

                // Legacy booking with no end time on record: block the whole
                // day rather than guessing how long it lasts.
                if (! $booking->jam_selesai) {
                    return true;
                }

                $bookingSelesai = substr($booking->jam_selesai, 0, 5);

                return $mulai < $bookingSelesai && $bookingMulai < $selesai;
            });
    }
}