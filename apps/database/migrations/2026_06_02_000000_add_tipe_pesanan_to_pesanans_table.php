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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('tipe_pesanan', ['regular', 'manual'])->default('regular')->after('id_kurir');
            $table->string('metode_pembayaran_manual')->nullable()->after('bukti_bayar')->comment('cash atau qris untuk pesanan manual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['tipe_pesanan', 'metode_pembayaran_manual']);
        });
    }
};
