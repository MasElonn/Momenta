<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FotograferAvailability;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AvailabilityController extends Controller
{
    public function __construct(
        protected FotograferAvailability $availability
    ) {}

    /**
     * Show the "Cek Ketersediaan Fotografer" page.
     */
    public function index(): View
    {
        return view('cek-ketersediaan');
    }

    /**
     * Check which fotografer are free for the requested date/time range and
     * return the result as JSON (consumed via fetch() from Alpine, no full
     * page reload).
     */
    public function check(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'waktu_mulai' => ['required', 'date_format:H:i'],
            'waktu_selesai' => ['required', 'date_format:H:i', 'after:waktu_mulai'],
        ], [
            'tanggal.required' => 'Tanggal acara wajib dipilih.',
            'tanggal.date' => 'Tanggal acara tidak valid.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_mulai.date_format' => 'Format waktu mulai tidak valid.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.date_format' => 'Format waktu selesai tidak valid.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);

        $tanggal = $validated['tanggal'];
        $mulai = $validated['waktu_mulai'];
        $selesai = $validated['waktu_selesai'];

        $busyIds = $this->availability->busyFotograferIds($tanggal, $mulai, $selesai);

        $hasil = User::where('role', 'fotografer')
            ->orderBy('name')
            ->get(['user_id', 'name'])
            ->map(fn (User $f) => [
                'id' => $f->user_id,
                'nama' => $f->name,
                'tersedia' => ! in_array($f->user_id, $busyIds, true),
                'tanggal' => Carbon::parse($tanggal)->translatedFormat('d F Y'),
                'waktu' => $mulai . ' - ' . $selesai,
            ])
            ->sortByDesc('tersedia')
            ->values();

        return response()->json([
            'jumlah_tersedia' => $hasil->where('tersedia', true)->count(),
            'fotografer' => $hasil,
        ]);
    }
}