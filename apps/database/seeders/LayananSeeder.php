<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_layanan' => 'Cuci Saja', 'harga_per_kg' => 7000],
            ['nama_layanan' => 'Setrika Saja', 'harga_per_kg' => 5000],
            ['nama_layanan' => 'Cuci + Setrika', 'harga_per_kg' => 15000],
        ];

        foreach ($data as $item) {
            Layanan::create($item);
        }
    }
}
