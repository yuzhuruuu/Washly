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

        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_layanan')->constrained('layanans', 'id_layanan');
            $table->foreignId('id_pelanggan')->constrained('pelanggans', 'id_pelanggan');
            $table->dateTime('tanggal_pesan');
            $table->decimal('berat', 8, 2)->nullable();
            $table->integer('total_harga')->default(0);
            $table->enum('status', ["menunggu_pickup", "menunggu_bayar", "proses", "delivery", "selesai"]);
            $table->text('catatan')->nullable();
            $table->dateTime('tanggal_pickup')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
