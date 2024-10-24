<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // Nama tabel di database

    protected $primaryKey = 'idrole'; // Primary key yang benar

    protected $fillable = [
        'nama_role'
    ];

    public $timestamps = false; // Nonaktifkan timestamps
}
