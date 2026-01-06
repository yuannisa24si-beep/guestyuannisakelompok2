<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix RW and RT table structures to match d.sql
     */
    public function up(): void
    {
        // Fix RW table
        if (Schema::hasTable('rw')) {
            Schema::table('rw', function (Blueprint $table) {
                // Add unique constraint on nomor_rw
                if (!Schema::hasUnique('rw', ['nomor_rw'])) {
                    $table->unique('nomor_rw');
                }

                // Make ketua_rw_warga_id nullable
                if (Schema::hasColumn('rw', 'ketua_rw_warga_id')) {
                    $table->unsignedBigInteger('ketua_rw_warga_id')->nullable()->change();
                }

                // Fix foreign key to use correct table (wargas)
                try {
                    $table->dropForeign(['ketua_rw_warga_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }

                $table->foreign('ketua_rw_warga_id')
                    ->references('warga_id')
                    ->on('wargas')
                    ->onDelete('set null');
            });
        }

        // Fix RT table
        if (Schema::hasTable('rt')) {
            Schema::table('rt', function (Blueprint $table) {
                // Add unique constraint on rw_id + nomor_rt
                if (!Schema::hasUnique('rt', ['rw_id', 'nomor_rt'])) {
                    $table->unique(['rw_id', 'nomor_rt']);
                }

                // Make ketua_rt_warga_id nullable
                if (Schema::hasColumn('rt', 'ketua_rt_warga_id')) {
                    $table->unsignedBigInteger('ketua_rt_warga_id')->nullable()->change();
                }

                // Fix foreign keys
                try {
                    $table->dropForeign(['rw_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }
                try {
                    $table->dropForeign(['ketua_rt_warga_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }

                $table->foreign('rw_id')
                    ->references('rw_id')
                    ->on('rw')
                    ->onDelete('cascade');

                $table->foreign('ketua_rt_warga_id')
                    ->references('warga_id')
                    ->on('wargas')
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
