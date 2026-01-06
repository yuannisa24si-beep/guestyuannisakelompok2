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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembaga_id');
            $table->string('nama_jabatan');
            $table->string('level');
            $table->timestamps();

            // Foreign key
            $table->foreign('lembaga_id')
                ->references('lembaga_id')
                ->on('lembaga_desa')
                ->onDelete('cascade');

            // Index
            $table->index('lembaga_id', 'jabatans_lembaga_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
