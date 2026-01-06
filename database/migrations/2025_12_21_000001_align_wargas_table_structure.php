<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix wargas table structure to match d.sql
     */
    public function up(): void
    {
        // Check if we need to rename 'warga' to 'wargas' and restructure
        if (Schema::hasTable('warga') && !Schema::hasTable('wargas')) {
            Schema::rename('warga', 'wargas');
        }

        if (!Schema::hasTable('wargas')) {
            Schema::create('wargas', function (Blueprint $table) {
                $table->id('warga_id');
                $table->string('no_ktp', 16)->unique();
                $table->string('nama', 100);
                $table->enum('jenis_kelamin', ['L', 'P']);
                $table->string('agama', 20);
                $table->string('pekerjaan', 50);
                $table->string('telp', 20);
                $table->string('email', 100)->nullable();
                $table->string('foto_profil_path', 255)->nullable();
                $table->timestamps();
            });
        } else {
            // Modify existing wargas table to match d.sql structure
            Schema::table('wargas', function (Blueprint $table) {
                // Add missing columns if they don't exist
                if (!Schema::hasColumn('wargas', 'no_ktp')) {
                    $table->string('no_ktp', 16)->unique()->after('warga_id');
                }
                if (!Schema::hasColumn('wargas', 'jenis_kelamin')) {
                    $table->enum('jenis_kelamin', ['L', 'P'])->after('nama');
                }
                if (!Schema::hasColumn('wargas', 'agama')) {
                    $table->string('agama', 20)->after('jenis_kelamin');
                }
                if (!Schema::hasColumn('wargas', 'pekerjaan')) {
                    $table->string('pekerjaan', 50)->after('agama');
                }
                if (!Schema::hasColumn('wargas', 'telp')) {
                    $table->string('telp', 20)->after('pekerjaan');
                }
                if (!Schema::hasColumn('wargas', 'foto_profil_path')) {
                    $table->string('foto_profil_path', 255)->nullable()->after('email');
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
