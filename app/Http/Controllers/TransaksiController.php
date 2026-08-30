<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Paket;

use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    /**
     * @throws \Exception
     */
    public function midtransCheckout(Request $req)
    {

        $paket = Paket::findOrFail($req->paket_id);

        $order = Transaksi::create([
            'customer_id'       => $req->user()->user_id,
            'paket_id'          => $paket->paket_id,
            'midtrans_order_id' => 'ORD-'.now()->format('YmdHi').'-'.$paket->paket_id,
            'status'            => 'pending',
        ]);

        $grossAmount = (int) $paket->harga;

        $params = [
            'transaction_details' => [
                'order_id'     => $order->midtrans_order_id,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => [[
                'id' => (string) $paket->paket_id,
                'price' => $grossAmount,
                'quantity' => 1,
                'name' => $paket->judul,
            ]],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->update(['snap_token' => $snapToken]);

        return response()->json(['snapToken' => $snapToken, 'order_id' => $order->midtrans_order_id]);
    }

    public function midtransWebhook(Request $req)
    {

        $payload = $req->all();
        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        if (!$orderId) return response()->json(['ok' => false], 400);

        $order = Transaksi::where('midtrans_order_id', $orderId)->firstOrFail();


        $map = [
            'settlement' => 'paid',
            'capture' => 'paid',
            'pending' => 'pending',
            'expire' => 'expired',
            'deny' => 'failed',
            'cancel' => 'failed'
        ];
        if($map[$transactionStatus] === 'paid'){
            $order->update(['status' => $map[$transactionStatus], 'paid_at' => now()->format('Y-m-d H:i:s')]);
        } else {
            $order->update(['status' => $map[$transactionStatus] ?? 'pending']);
        }


        return response()->json(['ok' => true]);
    }
}
