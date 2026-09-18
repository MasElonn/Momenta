<?php
namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Foto;
use App\Models\Transaksi;
use App\Models\Paket;

use App\Models\User;
use App\Services\UploadR2Service;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TransaksiController extends Controller
{
    public function __construct(
        protected UploadR2Service $r2
    ) {}
    public function index()
    {
    return view('pembayaran');
    }

    public function upload(Request $request){

        $request->validate([
           'bukti' => 'required|file|image|mimes:jpeg,png,jpg|max:3080',
        ]);

        $file = $request->file('bukti');
        $filename = $file->getClientOriginalName();
        $dir = 'bukti';


        $transaksi = Transaksi::where('trans_id',$request->trans_id)->firstOrFail();
        $upload = $this->r2->upload($file, $dir, $filename);

        if($upload){
            $transaksi->update([
                'bukti_bucket' => $dir,
                'bukti_key' => $upload,
                'status' => 'paid'
            ]);
            return redirect('/finish');
        }
        return redirect('/');

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
        session()->put([
            'trans_id' => $trans_id,
            'total_harga'=> $total_harga,
            'status' => Transaksi::where('trans_id', $trans_id)->first()->status,
            'paket' => Paket::where('paket_id', $paket_id)->first()->judul,
            'date_time' => $request->tanggal . ', ' . $request->jam,
            'lokasi' => $request->lokasi,
        ]);
        return redirect('pembayaran');


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
        $foto = Foto::where('acara_id', $acara_id)->firstOrFail();
        $transaksi = Transaksi::where('trans_id', $id)->firstOrFail();

        $transaksi->delete();
    }

}
