<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user'; // Nama tabel di database

    protected $primaryKey = 'iduser'; // Primary key yang sesuai dengan tabel

    protected $fillable = [
        'username', 'password', 'idrole'
    ];

    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
