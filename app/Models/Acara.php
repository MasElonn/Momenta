<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('acara')]
class Acara extends Model
{
    use HasFactory;

    protected $table = 'acara';
    protected $primaryKey = 'acara_id';
    protected $fillable = [
        'trans_id',
        'judul',
        'lokasi',
        'tanggal',
        'status',
        'jam',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'trans_id', 'trans_id');
    }
    public function foto()
    {
        return $this->hasMany(Foto::class, 'acara_id', 'acara_id');
    }
}
