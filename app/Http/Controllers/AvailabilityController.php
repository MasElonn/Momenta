<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\User;
use App\Services\FotograferAvailability;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function __construct(
        protected FotograferAvailability $availability
    ) {}

    public function check(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fotografer_id' => ['required', 'integer', 'exists:users,user_id'],
            'paket_id' => ['required', 'integer', 'exists:paket,paket_id'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai' => ['required', 'date_format:H:i'],
        ], [
            'tanggal.after_or_equal' => 'Tanggal acara tidak boleh di masa lalu.',
        ]);

        $fotografer = User::where('user_id', $validated['fotografer_id'])
            ->where('role', 'fotografer')
            ->first();

        if (!$fotografer) {
            return response()->json([
                'tersedia' => false,
                'message' => 'Fotografer tidak ditemukan.',
            ], 404);
        }

        $paket = Paket::where('paket_id', $validated['paket_id'])
            ->where('fotografer_id', $fotografer->user_id)
            ->where('tersedia', true)
            ->first();

        if (!$paket) {
            return response()->json([
                'tersedia' => false,
                'message' => 'Paket tidak tersedia.',
            ], 422);
        }

        preg_match('/\d+/', $paket->durasi, $matches);

        $durasiMenit = (int) ($matches[0] ?? 0);

        if ($durasiMenit <= 0) {
            return response()->json([
                'tersedia' => false,
                'message' => 'Durasi paket tidak valid.',
            ], 422);
        }

        $mulai = Carbon::createFromFormat('H:i', $validated['jam_mulai']);
        $selesai = $mulai->copy()->addMinutes($durasiMenit);

        if ($selesai->format('Y-m-d') !== $mulai->format('Y-m-d')) {
            return response()->json([
                'tersedia' => false,
                'message' => 'Jam selesai tidak boleh melewati tengah malam.',
            ], 422);
        }

        $jamSelesai = $selesai->format('H:i');

        $tersedia = $this->availability->isFree(
            (int) $fotografer->user_id,
            $validated['tanggal'],
            $validated['jam_mulai'],
            $jamSelesai
        );

        return response()->json([
            'tersedia' => $tersedia,
            'jam_selesai' => $jamSelesai,
            'durasi' => $durasiMenit,
            'message' => $tersedia
                ? 'Jadwal fotografer tersedia.'
                : 'Maaf, fotografer sudah memiliki booking pada waktu tersebut.',
        ]);
    }
}
