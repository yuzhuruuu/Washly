<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_pelanggan', 'id_layanan', 'tanggal_pesan', 'berat', 
        'total_harga', 'status', 'catatan', 'tanggal_pickup', 'tanggal_selesai'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'id_pesanan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pesanan');
    }
}