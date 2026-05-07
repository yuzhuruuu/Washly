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

        Schema::create('kurirs', function (Blueprint $table) {
            $table->id('id_kurir');
            $table->string('nama');
            $table->string('no_hp');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurirs');
    }
};
