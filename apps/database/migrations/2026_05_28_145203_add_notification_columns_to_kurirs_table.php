<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kurirs', function (Blueprint $table) {
            // Kita tambahkan kolom baru dengan tipe boolean (default 1 / aktif)
            // Kita sesuaikan nama kolomnya dengan script update kita sebelumnya
            $table->boolean('notif_tugas')->default(1)->after('no_hp');
            $table->boolean('notif_pesan')->default(1)->after('notif_tugas');
            $table->boolean('notif_promo')->default(0)->after('notif_pesan'); // default OFF
        });
    }

    public function down(): void
    {
        Schema::table('kurirs', function (Blueprint $table) {
            $table->dropColumn(['notif_tugas', 'notif_pesan', 'notif_promo']);
        });
    }
};