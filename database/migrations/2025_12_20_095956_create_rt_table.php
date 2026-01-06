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
        Schema::create('rt', function (Blueprint $table) {
            $table->id('rt_id');
            $table->unsignedBigInteger('rw_id');
            $table->string('nomor_rt', 10);
            $table->unsignedBigInteger('ketua_rt_warga_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Unique constraint
            $table->unique(['rw_id', 'nomor_rt'], 'rt_rw_id_nomor_rt_unique');

            // Foreign keys
            $table->foreign('rw_id')
                ->references('rw_id')
                ->on('rw')
                ->onDelete('cascade');

            $table->foreign('ketua_rt_warga_id')
                ->references('warga_id')
                ->on('wargas')
                ->onDelete('set null');

            // Indexes
            $table->index('ketua_rt_warga_id', 'rt_ketua_rt_warga_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rt');
    }
};
