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
            // Tambah kolom id_kurir setelah id_pelanggan
            // Kita buat nullable() karena pas awal dipesan kan belum tentu langsung dapet kurir
            $table->unsignedBigInteger('id_kurir')->nullable()->after('id_pelanggan');

            // Bikin foreign key biar nyambung ke tabel kurirs
            $table->foreign('id_kurir')->references('id_kurir')->on('kurirs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['id_kurir']);
            $table->dropColumn('id_kurir');
        });
    }
};
