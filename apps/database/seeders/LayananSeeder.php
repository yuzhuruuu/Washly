<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Layanan::create([
        'nama_layanan' => 'Cuci Kering',
        'harga_per_kg' => 6000
    ]);

    \App\Models\Layanan::create([
        'nama_layanan' => 'Cuci Setrika',
        'harga_per_kg' => 8000
    ]);

    \App\Models\Layanan::create([
        'nama_layanan' => 'Setrika Saja',
        'harga_per_kg' => 5000
    ]);
    }
}
