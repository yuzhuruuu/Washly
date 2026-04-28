<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $primaryKey = 'id_detail';

    // Daftarkan kolom yang boleh diisi otomatis
    protected $fillable = [
        'id_pesanan',
        'id_layanan',
        'berat',
        'subtotal'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}