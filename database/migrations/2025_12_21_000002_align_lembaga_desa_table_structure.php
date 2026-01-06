<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix lembaga_desa table structure to match d.sql
     */
    public function up(): void
    {
        // Check if we need to rename 'lembaga' to 'lembaga_desa'
        if (Schema::hasTable('lembaga') && !Schema::hasTable('lembaga_desa')) {
            Schema::rename('lembaga', 'lembaga_desa');
        }

        if (!Schema::hasTable('lembaga_desa')) {
            Schema::create('lembaga_desa', function (Blueprint $table) {
                $table->id('lembaga_id');
                $table->string('nama_lembaga', 100);
                $table->string('deskripsi', 225);
                $table->string('kontak', 255)->nullable();
                $table->timestamps();
            });
        } else {
            // Modify existing lembaga_desa table to match d.sql structure
            Schema::table('lembaga_desa', function (Blueprint $table) {
                // Ensure proper column sizes
                if (Schema::hasColumn('lembaga_desa', 'nama_lembaga')) {
                    $table->string('nama_lembaga', 100)->change();
                }
                if (!Schema::hasColumn('lembaga_desa', 'deskripsi')) {
                    $table->string('deskripsi', 225)->after('nama_lembaga');
                } else {
                    $table->string('deskripsi', 225)->change();
                }
                if (!Schema::hasColumn('lembaga_desa', 'kontak')) {
                    $table->string('kontak', 255)->nullable()->after('deskripsi');
                }
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
