<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // nama tabel di database
    protected $primaryKey = 'id_user'; // primary key custom

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan saat serialisasi (misalnya ke JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting otomatis
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
