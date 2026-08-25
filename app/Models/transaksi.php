<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('transaksi')]
class Transaksi extends Model
{

    protected $primaryKey = 'trans_id';

    protected $fillable = [
        'customer_id',
        'paket_id',
        'midtrans_order_id',
        'snap_token',
        'payment_type',
        'status',
        'paid_at',
    ];
    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'paket_id');
    }

    public function acara()
    {
        return $this->hasOne(Acara::class, 'trans_id', 'trans_id');
    }


}
