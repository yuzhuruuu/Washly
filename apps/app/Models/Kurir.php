<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurir extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'kurirs';
    protected $primaryKey = 'id_kurir';

    protected $fillable = [
        'nama', 'username', 'password', 'no_hp', 'status', 'notify_new_task',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'notify_new_task' => 'boolean',
    ];

    // Relasi: Kurir bisa jemput banyak pengiriman
    public function pickups()
    {
        return $this->hasMany(Pengiriman::class, 'id_kurir_pickup');
    }

    // Relasi: Kurir bisa antar banyak pengiriman
    public function deliveries()
    {
        return $this->hasMany(Pengiriman::class, 'id_kurir_antar');
    }

    public function pesanan()
    {
        // Pastikan nama foreign key-nya 'id_kurir' sesuai tabel kamu
        return $this->hasMany(Pesanan::class, 'id_kurir');
    }
}
