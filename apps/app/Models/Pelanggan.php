<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Kasih tahu Laravel kalau tabelnya bukan 'users' tapi 'pelanggans'
    protected $table = 'pelanggans';

    // 2. Kasih tahu Primary Key-nya bukan 'id' tapi 'id_pelanggan'
    protected $primaryKey = 'id_pelanggan';

    /**
     * Atribut yang bisa diisi secara massal.
     * Sesuaikan dengan kolom yang ada di migrasi pelanggans!
     */
    protected $fillable = [
        'nama',      // Tadi di migrasi kamu 'nama', bukan 'name' kan?
        'email',
        'password',
        'no_hp',     // Tambahkan ini
        'alamat',    // Tambahkan ini
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi (seperti API).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data otomatis.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELASI: Satu Pelanggan punya banyak Pesanan
     */
    public function pesanans()
    {
        // Parameter kedua adalah Foreign Key di tabel pesanans
        return $this->hasMany(Pesanan::class, 'id_pelanggan');
    }
}