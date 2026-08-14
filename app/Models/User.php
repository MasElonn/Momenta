<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
      'user_id',
      'role',
      'name',
      'email',
      'password',
      'no_hp',
      'created_at',
      'updated_at',

    ];
}
