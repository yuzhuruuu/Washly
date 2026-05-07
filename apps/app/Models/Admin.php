<?php

namespace App\Models;

// Import library untuk authentication
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kasih tahu Laravel nama tabel aslinya
    protected $table = 'admins';

    // Kasih tahu Primary Key-nya karena kita pakai 'id_admin'
    protected $primaryKey = 'id_admin';

    /**
     * Atribut yang bisa diisi secara massal (Mass Assignable).
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi (seperti API).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut (misal password harus di-hash).
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}