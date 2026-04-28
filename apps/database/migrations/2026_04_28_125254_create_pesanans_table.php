<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id('id_pesanan');
        // Relasi ke tabel users (siapa yang pesan)
        $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
        
        $table->date('tanggal_pesan');
        $table->enum('status', ['menunggu', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu');
        $table->decimal('total_harga', 10, 2)->default(0);
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
