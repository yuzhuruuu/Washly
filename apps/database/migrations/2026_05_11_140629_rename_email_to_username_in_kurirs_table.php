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
        Schema::table('kurirs', function (Blueprint $table) {
            // Mengubah nama kolom email menjadi username
            $table->renameColumn('email', 'username');
        });
    }

    public function down(): void
    {
        Schema::table('kurirs', function (Blueprint $table) {
            $table->renameColumn('username', 'email');
        });
    }
};
