<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('paket')]
class Paket extends Model
{

    protected $primaryKey = 'paket_id';
    protected $fillable = [
        'fotografer_id',
        'judul',
        'deskripsi',
        'harga',
    ];
    protected $casts = [
        'harga' => 'decimal:2',
    ];


    public function fotografer()
    {
        return $this->belongsTo(User::class, 'fotografer_id', 'user_id');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'paket_id', 'paket_id');
    }
}
