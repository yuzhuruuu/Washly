<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';
    protected $primaryKey = 'id_pengiriman';

    protected $fillable = [
        'id_pesanan', 'id_kurir_pickup', 'id_kurir_antar', 
        'alamat_jemput', 'alamat_antar', 'status_pengiriman', 
        'waktu_jemput', 'waktu_antar'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function kurirPickup()
    {
        return $this->belongsTo(Kurir::class, 'id_kurir_pickup');
    }

    public function kurirAntar()
    {
        return $this->belongsTo(Kurir::class, 'id_kurir_antar');
    }
}