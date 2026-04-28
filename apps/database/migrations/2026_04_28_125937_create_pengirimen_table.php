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
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->foreignId('id_pesanan')->unique()->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
            $table->foreignId('id_kurir')->constrained('kurirs', 'id_kurir');
            $table->text('alamat_jemput');
            $table->text('alamat_antar');
            $table->enum('status_pengiriman', ['menunggu', 'dijemput', 'diantar', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
