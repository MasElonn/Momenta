<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('foto')]
class Foto extends Model
{

    protected $primaryKey = 'foto_id';

    protected $fillable = [
        'acara_id',
        'r2_bucket',
        'r2_key',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'acara_id', 'acara_id');
    }

    public function url(): string
    {
        return sprintf(
            '%s/%s/%s',
            rtrim(config('filesystems.disks.r2.url'), '/'),
            $this->r2_bucket,
            $this->r2_key
        );
    }
}
