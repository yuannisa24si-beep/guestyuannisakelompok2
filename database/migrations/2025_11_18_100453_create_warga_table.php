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
        Schema::create('warga', function (Blueprint $table) {
           $table->id('warga_id'); // Primary Key
            $table->string('nama');
            $table->string('email')->unique(); // 🆕 Tambahkan email yang unik
            $table->string('password'); // 🆕 Tambahkan password
            $table->string('nik', 16)->unique(); // NIK
            $table->text('alamat')->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('role');
            $table->rememberToken(); // 🆕 Tambahkan remember token untuk otentikasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
