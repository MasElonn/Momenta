<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Table('users')]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'no_hp',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
    public function paket()
    {
        return $this->hasMany(Paket::class, 'fotografer_id', 'user_id');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'customer_id', 'user_id');
    }
}
