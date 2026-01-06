<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix anggota_lembaga foreign keys to use correct table names
     */
    public function up(): void
    {
        // Modify anggota_lembaga table to use correct foreign keys
        if (Schema::hasTable('anggota_lembaga')) {
            // Drop old constraints if they exist
            Schema::table('anggota_lembaga', function (Blueprint $table) {
                // Drop old foreign keys if they reference wrong tables
                try {
                    $table->dropForeign(['lembaga_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }
                try {
                    $table->dropForeign(['warga_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }
                try {
                    $table->dropForeign(['jabatan_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }
            });

            // Add correct foreign keys
            Schema::table('anggota_lembaga', function (Blueprint $table) {
                if (!Schema::hasColumn('anggota_lembaga', 'tgl_mulai')) {
                    $table->date('tgl_mulai');
                }
                if (!Schema::hasColumn('anggota_lembaga', 'tgl_selesai')) {
                    $table->date('tgl_selesai')->nullable();
                }

                // Add foreign keys with correct table references
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
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert would be complex, but for safety we don't drop
    }
};
