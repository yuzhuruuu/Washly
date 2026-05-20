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
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->string('username')->unique()->after('nama')->nullable();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->string('username')->unique()->after('nama')->nullable();
        });
}

    public function down(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) { $table->dropColumn('username'); });
        Schema::table('admins', function (Blueprint $table) { $table->dropColumn('username'); });
    }
};
