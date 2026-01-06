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
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id('perangkat_id');
            $table->unsignedBigInteger('warga_id');
            $table->string('jabatan');
            $table->string('nip')->nullable()->unique();
            $table->string('kontak')->nullable()->unique();
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('wargas')
                ->onDelete('cascade');

            // Index
            $table->index('warga_id', 'perangkat_desa_warga_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
