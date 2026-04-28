<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // Kasih tahu Laravel kalau Primary Key-nya bukan 'id', tapi 'id_layanan'
    protected $primaryKey = 'id_layanan';

    // Kasih tahu kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama_layanan',
        'harga_per_kg',
    ];

    /**
     * Relasi: Satu layanan bisa ada di banyak detail pesanan
     */
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'id_layanan');
    }
}
