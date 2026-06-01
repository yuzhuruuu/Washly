<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Eksekusi data layanan dari LayananSeeder yang udah lu buat
        $this->call([
            LayananSeeder::class,
        ]);

        // 2. Buat Data Admin (WAJIB biar lu bisa masuk ke dashboard)
        Admin::create([
            'nama' => 'Admin Washly',
            'username' => 'admin_washly',
            'email' => 'washly.admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        
        // Pelanggan dan Kurir dikosongin total biar nanti daftar sendiri di aplikasi yang udah online!
    }
}