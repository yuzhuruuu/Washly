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
        Schema::disableForeignKeyConstraints();

        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->foreignId('id_pesanan')->constrained('pesanans', 'id_pesanan');
            $table->foreignId('id_kurir_pickup')->nullable()->constrained('kurirs', 'id_kurir');
            $table->foreignId('id_kurir_antar')->nullable()->constrained('kurirs', 'id_kurir');
            $table->text('alamat_jemput');
            $table->text('alamat_antar');
            $table->enum('status_pengiriman', ["pending", "dalam_proses", "selesai"]);
            $table->dateTime('waktu_jemput');
            $table->dateTime('waktu_antar');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
