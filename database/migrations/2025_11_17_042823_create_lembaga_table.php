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
        Schema::create('lembaga_desa', function (Blueprint $table) {
            $table->id('lembaga_id');
            $table->string('nama_lembaga', 100);
            $table->string('deskripsi', 225);
            $table->string('kontak', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga_desa');
    }
};
