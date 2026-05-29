<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';
    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'nama_layanan', 'harga_per_kg',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_layanan');
    }
}