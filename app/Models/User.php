<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status_akun',
        'no_hp',
        'avatar',
        'foto_karya',
        'bio',
        'lokasi',
        'instagram',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pakets()
    {
        return $this->hasMany(Paket::class, 'fotografer_id', 'user_id');
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->avatar) {
                    return null;
                }
                if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
                    return $this->avatar;
                }
                if (file_exists(public_path($this->avatar))) {
                    return asset($this->avatar);
                }
                return asset('storage/' . ltrim($this->avatar, '/'));
            }
        );
    }

    protected function fotoKaryaUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->foto_karya) {
                    if (str_starts_with($this->foto_karya, 'http://') || str_starts_with($this->foto_karya, 'https://')) {
                        return $this->foto_karya;
                    }
                    if (file_exists(public_path($this->foto_karya))) {
                        return asset($this->foto_karya);
                    }
                    return asset('storage/' . ltrim($this->foto_karya, '/'));
                }
                return asset('images/wisuda2.webp');
            }
        );
    }
}