<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    // Tentukan primary key-nya kalau bukan 'id'
    protected $primaryKey = 'id_pembayaran';

    // Daftarkan kolom yang boleh diisi melalui form/controller
    protected $fillable = [
        'id_pesanan',
        'tanggal_bayar',
        'jumlah_bayar',
        'bukti_bayar',
        'status_pembayaran'
    ];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}