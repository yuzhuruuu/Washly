<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pelanggans';

    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',      
        'email',
        'username',  
        'password',
        'no_hp',     
        'alamat',   
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

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan');
    }
}