<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix perangkat_desa table structure to match d.sql
     */
    public function up(): void
    {
        if (Schema::hasTable('perangkat_desa')) {
            Schema::table('perangkat_desa', function (Blueprint $table) {
                // Add foto column if missing
                if (!Schema::hasColumn('perangkat_desa', 'foto')) {
                    $table->string('foto', 255)->nullable()->after('periode_selesai');
                }

                // Add unique constraints
                if (!Schema::hasUnique('perangkat_desa', ['nip'])) {
                    $table->unique('nip');
                }
                if (!Schema::hasUnique('perangkat_desa', ['kontak'])) {
                    $table->unique('kontak');
                }

                // Fix foreign key to use correct table (wargas)
                try {
                    $table->dropForeign(['warga_id']);
                } catch (\Exception $e) {
                    // FK might not exist or have different name
                }

                $table->foreign('warga_id')
                    ->references('warga_id')
                    ->on('wargas')
                    ->onDelete('cascade');
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
