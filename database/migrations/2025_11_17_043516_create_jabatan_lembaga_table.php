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
         Schema::create('jabatan_lembaga', function (Blueprint $table) {
            $table->id('jabatan_id'); // Kunci Utama (Primary Key - PK)
            $table->foreignId('lembaga_id')->constrained('lembaga', 'lembaga_id')->onDelete('cascade'); // Kunci Asing (Foreign Key - FK)
            $table->string('nama_jabatan');
            $table->integer('level')->comment('Level jabatan: 1 (Puncak), 2, 3, dst.');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_lembaga');
    }
};
