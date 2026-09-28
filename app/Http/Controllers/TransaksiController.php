<?php
namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Foto;
use App\Models\Transaksi;
use App\Models\Paket;

use App\Models\User;
use App\Services\UploadR2Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TransaksiController extends Controller
{
    public function __construct(
        protected UploadR2Service $r2
    ) {}
    public function index(string $id)
    {
        $transaksi = Transaksi::with(['paket', 'acara'])->where('trans_id', $id)->firstOrFail();

        return view('pembayaran', [
            'trans_id'    => $transaksi->trans_id,
            'total_harga' => $transaksi->paket?->harga ?? 0,
            'status'      => $transaksi->status,
            'paket'       => $transaksi->paket?->judul,
            'date_time'   => $transaksi->acara ? ($transaksi->acara->tanggal ? $transaksi->acara->tanggal->format('Y-m-d') : '') . ', ' . $transaksi->acara->jam : null,
            'lokasi'      => $transaksi->acara?->lokasi,
        ]);
    }

    public function upload(Request $request){

        $request->validate([
           'bukti' => 'required|file|image|mimes:jpeg,png,jpg|max:3080',
        ]);

        $file = $request->file('bukti');
        $filename = $file->getClientOriginalName();
        $transaksi = Transaksi::where('trans_id',$request->trans_id)->firstOrFail();
        $dir = $transaksi->trans_id . '/bukti';

        $upload = $this->r2->upload($file, $dir, $filename);

        if($upload){
            $transaksi->update([
                'bukti_bucket' => $dir,
                'bukti_key' => $upload,
                'status' => 'paid',
                'paid_at' => now(),
            ]);
            return redirect()->route('finish', ['id' => $transaksi->trans_id]);
        }
        return redirect('/');

    }

    public function finish(?string $id = null)
    {
        $transaksi = null;
        if ($id) {
            $transaksi = Transaksi::with(['paket', 'acara'])->where('trans_id', $id)->first();
        }

        return view('finish', [
            'transaksi' => $transaksi,
            'trans_id' => $transaksi?->trans_id ?? session('trans_id'),
            'paket' => $transaksi?->paket?->judul ?? session('paket'),
            'date_time' => $transaksi?->acara ? (($transaksi->acara->tanggal?->translatedFormat('d M Y') ?? $transaksi->acara->tanggal) . ', ' . $transaksi->acara->jam) : session('date_time'),
            'lokasi' => $transaksi?->acara?->lokasi ?? session('lokasi'),
            'total_harga' => $transaksi?->paket?->harga ?? session('total_harga', 0),
        ]);
    }

    public function create(Request $request){

        $request->validate([
            'judul_acara' => 'required',
            'paket_id'    => 'required',
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'lokasi'      => 'required',
            'deskripsi'   => 'nullable|string',
        ]);

        $customer_id = $request->customer_id;
        $paket_id = $request->paket_id;

        $total_harga = Paket::where('paket_id', $paket_id)->first()->harga;

        $trans_id = 'BK-' . $customer_id . '-' . $paket_id . '-' . Str::Random(5);

        Transaksi::create([
            'trans_id' => $trans_id,
            'customer_id' => $customer_id,
            'paket_id' => $paket_id,
            'status' => 'unpaid'
        ]);
        Acara::create([
            'trans_id' => $trans_id,
            'judul' => $request->judul_acara,
            'lokasi' => $request->lokasi,
            'tanggal' =>  $request->tanggal,
            'jam' => $request->jam,
            'deskripsi' => $request->deskripsi,
            'status' => 'upcoming',
        ]);
        return redirect()->route('pembayaran', ['id' => $trans_id]);


    }
    public function show(string $id)
    {
        $fotografer = User::where('role', 'fotografer')->where('user_id', $id)->firstOrFail();
        $fid = $fotografer->user_id;
        $fname = $fotografer->name;

        $pakets = Paket::where('fotografer_id', $fid)->get();

        return view('booking',
            ['pakets' => $pakets,
                'fname' => $fname,
                'fid' => $fid,
            ]);
    }
    public function destroy(string $id){
        $acara_id = Acara::where('trans_id', $id)->first()->acara_id;

        $acara = Acara::where('trans_id', $id)->firstOrFail();
        $foto = Foto::where('acara_id', $acara_id)->get();
        $transaksi = Transaksi::where('trans_id', $id)->firstOrFail();

        if($foto->isNotEmpty()){
            if(Storage::disk('r2')->deleteDirectory('foto/' . $acara_id)){
                $foto->each->delete();
            }

        }
        $acara->delete();
        $transaksi->delete();


        return redirect()->route('dashboard');
    }

}
