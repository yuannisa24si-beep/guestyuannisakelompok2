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
            $table->string('nik', 16)->unique(); // NIK biasanya 16 digit dan unik
            $table->text('alamat')->nullable();
            $table->string('telepon', 15)->nullable();
             $table->string('role');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
