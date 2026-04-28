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
    Schema::create('detail_pesanans', function (Blueprint $table) {
        $table->id('id_detail');
        $table->foreignId('id_pesanan')->constrained('pesanans', 'id_pesanan')->onDelete('cascade');
        $table->foreignId('id_layanan')->constrained('layanans', 'id_layanan');
        $table->decimal('berat', 5, 2);
        $table->decimal('subtotal', 10, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
