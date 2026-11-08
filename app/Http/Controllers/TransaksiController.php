<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Foto;
use App\Models\Transaksi;
use App\Models\Paket;
use App\Models\User;
use App\Services\UploadR2Service;
use App\Services\FotograferAvailability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function __construct(
        protected UploadR2Service $r2,
        protected FotograferAvailability $availability
    ) {}

    public function index(string $id)
    {
        $transaksi = Transaksi::with(['paket', 'acara'])
            ->where('trans_id', $id)
            ->firstOrFail();

        return view('pembayaran', [
            'trans_id' => $transaksi->trans_id,
            'total_harga' => $transaksi->paket?->harga ?? 0,
            'status' => $transaksi->status,
            'paket' => $transaksi->paket?->judul,
            'date_time' => $transaksi->acara
                ? ($transaksi->acara->tanggal
                    ? $transaksi->acara->tanggal->format('Y-m-d')
                    : '') . ', ' . $transaksi->acara->jam
                : null,
            'lokasi' => $transaksi->acara?->lokasi,
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'bukti' => 'required|file|image|mimes:jpeg,png,jpg|max:3080',
        ]);

        $file = $request->file('bukti');
        $filename = $file->getClientOriginalName();

        $transaksi = Transaksi::where('trans_id', $request->trans_id)
            ->firstOrFail();

        $dir = $transaksi->trans_id . '/bukti';

        $upload = $this->r2->upload($file, $dir, $filename);

        if ($upload) {
            $transaksi->update([
                'bukti_bucket' => $dir,
                'bukti_key' => $upload,
                'status' => 'pending',
                'paid_at' => now(),
            ]);

            return redirect()->route('finish', [
                'id' => $transaksi->trans_id,
            ]);
        }

        return redirect('/');
    }

    public function finish(?string $id = null)
    {
        $transaksi = null;

        if ($id) {
            $transaksi = Transaksi::with(['paket', 'acara'])
                ->where('trans_id', $id)
                ->first();
        }

        return view('finish', [
            'transaksi' => $transaksi,
            'trans_id' => $transaksi?->trans_id ?? session('trans_id'),
            'paket' => $transaksi?->paket?->judul ?? session('paket'),
            'date_time' => $transaksi?->acara
                ? (($transaksi->acara->tanggal?->translatedFormat('d M Y')
                    ?? $transaksi->acara->tanggal) . ', ' . $transaksi->acara->jam)
                : session('date_time'),
            'lokasi' => $transaksi?->acara?->lokasi ?? session('lokasi'),
            'total_harga' => $transaksi?->paket?->harga
                ?? session('total_harga', 0),
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'fotografer_id' => [
                'required',
                'integer',
                'exists:users,user_id',
            ],
            'paket_id' => [
                'required',
                'integer',
                'exists:paket,paket_id',
            ],
            'judul_acara' => [
                'required',
                'string',
                'max:255',
            ],
            'tanggal' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'jam' => [
                'required',
                'date_format:H:i',
            ],
            'lokasi' => [
                'required',
                'string',
                'max:255',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
        ]);

        $customerId = auth()->id();

        if (!$customerId) {
            return redirect()->route('login');
        }

        $fotografer = User::where('user_id', $validated['fotografer_id'])
            ->where('role', 'fotografer')
            ->first();

        if (!$fotografer) {
            return back()
                ->withInput()
                ->withErrors([
                    'fotografer_id' => 'Fotografer tidak ditemukan.',
                ]);
        }

        $paket = Paket::where('paket_id', $validated['paket_id'])
            ->where('fotografer_id', $fotografer->user_id)
            ->where('tersedia', true)
            ->first();

        if (!$paket) {
            return back()
                ->withInput()
                ->withErrors([
                    'paket_id' => 'Paket tidak tersedia untuk fotografer ini.',
                ]);
        }

        preg_match('/\d+/', $paket->durasi, $matches);

        $durasiMenit = (int) ($matches[0] ?? 0);

        if ($durasiMenit <= 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'paket_id' => 'Durasi paket tidak valid.',
                ]);
        }

        $mulai = Carbon::createFromFormat('H:i', $validated['jam']);
        $selesai = $mulai->copy()->addMinutes($durasiMenit);

        if ($selesai->format('Y-m-d') !== $mulai->format('Y-m-d')) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam' => 'Jam selesai tidak boleh melewati tengah malam.',
                ]);
        }

        $jamSelesai = $selesai->format('H:i');

        $tersedia = $this->availability->isFree(
            (int) $fotografer->user_id,
            $validated['tanggal'],
            $validated['jam'],
            $jamSelesai
        );

        if (!$tersedia) {
            return back()
                ->withInput()
                ->withErrors([
                    'jam' => 'Jadwal fotografer sudah terisi. Silakan pilih waktu lain.',
                ]);
        }

        $transId = 'BK-' . $customerId . '-' . $paket->paket_id . '-' . Str::random(5);

        DB::transaction(function () use (
            $transId,
            $customerId,
            $paket,
            $validated,
            $jamSelesai
        ) {
            Transaksi::create([
                'trans_id' => $transId,
                'customer_id' => $customerId,
                'paket_id' => $paket->paket_id,
                'status' => 'unpaid',
            ]);

            Acara::create([
                'trans_id' => $transId,
                'judul' => $validated['judul_acara'],
                'lokasi' => $validated['lokasi'],
                'tanggal' => $validated['tanggal'],
                'jam' => $validated['jam'],
                'jam_selesai' => $jamSelesai,
                'deskripsi' => $validated['deskripsi'] ?? null,
                'status' => 'upcoming',
            ]);
        });

        return redirect()->route('pembayaran', [
            'id' => $transId,
        ]);
    }

    public function show(string $id)
    {
        $fotografer = User::where('role', 'fotografer')
            ->where('user_id', $id)
            ->firstOrFail();

        $fid = $fotografer->user_id;
        $fname = $fotografer->name;

        $pakets = Paket::where('fotografer_id', $fid)
            ->where('tersedia', true)
            ->get();

        return view('booking', [
            'pakets' => $pakets,
            'fname' => $fname,
            'fid' => $fid,
        ]);
    }

    public function destroy(string $id)
    {
        $acara = Acara::where('trans_id', $id)->firstOrFail();

        $acara_id = $acara->acara_id;

        $foto = Foto::where('acara_id', $acara_id)->get();

        $transaksi = Transaksi::where('trans_id', $id)
            ->firstOrFail();

        if ($foto->isNotEmpty()) {
            if (Storage::disk('r2')->deleteDirectory('foto/' . $acara_id)) {
                $foto->each->delete();
            }
        }

        $acara->delete();
        $transaksi->delete();

        return redirect()->route('dashboard');
    }

    public function accept(string $id)
    {
        $transaksi = Transaksi::with('paket')
            ->where('trans_id', $id)
            ->firstOrFail();

        if (
            $transaksi->status !== 'pending' ||
            $transaksi->paket?->fotografer_id !== auth()->id()
        ) {
            abort(403);
        }

        $transaksi->status = 'paid';
        $transaksi->verified_at = now();
        $transaksi->save();

        return back()->with('success', 'Payment accepted');
    }

    public function reject(Request $request, string $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $transaksi = Transaksi::with('paket')
            ->where('trans_id', $id)
            ->firstOrFail();

        if (
            $transaksi->status !== 'pending' ||
            $transaksi->paket?->fotografer_id !== auth()->id()
        ) {
            abort(403);
        }

        $transaksi->status = 'rejected';
        $transaksi->rejection_reason = $request->rejection_reason;
        $transaksi->save();

        return back()->with('success', 'Payment rejected');
    }
}
