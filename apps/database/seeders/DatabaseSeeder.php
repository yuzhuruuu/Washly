<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\Kurir;
use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LayananSeeder::class,
        ]);

        // 1. Buat Data Admin
        Admin::create([
            'nama' => 'Admin Washly',
            'email' => 'admin@washly.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Buat Data Pelanggan
        Pelanggan::create([
            'nama' => 'Zayn Malik',
            'email' => 'javvad@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081234567890',
            'alamat' => 'Banaran, Gunungpati, Semarang',
        ]);

        // 3. Buat Data Kurir
        Kurir::create([
            'nama' => 'Budi Kurir',
            'email' => 'budi@washly.com',
            'password' => Hash::make('password123'),
            'no_hp' => '08987654321',
            'status' => 'aktif',
        ]);
    }
}