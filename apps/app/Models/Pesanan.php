<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';    
    protected $primaryKey = 'id_pesanan';

        // Daftarkan kolom yang boleh diisi otomatis
        protected $fillable = [
            'id_user',
            'id_layanan',
            'berat',
            'total_harga',
            'status'
        ];
    
    public function pembayaran()
    {
        // Satu pesanan memiliki satu pembayaran
        return $this->hasOne(Pembayaran::class, 'id_pesanan', 'id_pesanan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }
}