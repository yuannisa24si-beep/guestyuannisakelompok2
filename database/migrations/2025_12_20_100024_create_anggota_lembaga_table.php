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
        Schema::create('anggota_lembaga', function (Blueprint $table) {
            $table->id('anggota_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('lembaga_id')
                ->references('lembaga_id')
                ->on('lembaga_desa')
                ->onDelete('cascade');

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('wargas')
                ->onDelete('cascade');

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatans')
                ->onDelete('set null');

            // Indexes
            $table->index('warga_id', 'anggota_lembaga_warga_id_foreign');
            $table->index('jabatan_id', 'anggota_lembaga_jabatan_id_foreign');
            $table->index(['lembaga_id', 'warga_id', 'tgl_mulai', 'tgl_selesai'], 'anggota_lembaga_lembaga_id_warga_id_tgl_mulai_tgl_selesai_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_lembaga');
    }
};
