<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paket';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'paket_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fotografer_id',
        'judul',
        'deskripsi',
        'harga',
        'durasi',
        'jumlah_foto',
        'jumlah_fotografer',
        'durasi_galeri',
        'is_populer',
        'tersedia',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'is_populer' => 'boolean',
            'tersedia' => 'boolean',
        ];
    }

    /**
     * The fotografer (photographer) that owns this package.
     */
    public function fotografer()
    {
        return $this->belongsTo(User::class, 'fotografer_id', 'user_id');
    }

    /**
     * Harga formatted into short Indonesian Rupiah notation.
     *
     * 500000    -> "Rp 500rb"
     * 750000    -> "Rp 750rb"
     * 1200000   -> "Rp 1,2jt"
     * 2000000   -> "Rp 2jt"
     */
    protected function hargaFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => self::formatHargaShort((float) $this->harga)
        );
    }

    /**
     * Reusable short-Rupiah formatter — used by the hargaFormatted accessor
     * above, and also directly for aggregate values (e.g. an average price
     * across several packages) that don't belong to a single model instance.
     */
    public static function formatHargaShort(float $value): string
    {
        if ($value >= 1_000_000) {
            $jt = $value / 1_000_000;
            $formatted = number_format($jt, 1, ',', '.');
            $formatted = rtrim(rtrim($formatted, '0'), ',');

            return 'Rp ' . $formatted . 'jt';
        }

        if ($value >= 1_000) {
            return 'Rp ' . round($value / 1000) . 'rb';
        }

        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}