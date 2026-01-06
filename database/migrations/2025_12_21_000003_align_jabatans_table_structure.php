<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix jabatan table to match d.sql (should be 'jabatans')
     */
    public function up(): void
    {
        // Check if we need to rename 'jabatan_lembaga' to 'jabatans'
        if (Schema::hasTable('jabatan_lembaga') && !Schema::hasTable('jabatans')) {
            Schema::rename('jabatan_lembaga', 'jabatans');
        }

        if (!Schema::hasTable('jabatans')) {
            Schema::create('jabatans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('lembaga_id');
                $table->string('nama_jabatan');
                $table->string('level');
                $table->timestamps();

                $table->foreign('lembaga_id')
                    ->references('lembaga_id')
                    ->on('lembaga_desa')
                    ->onDelete('cascade');
            });
        } else {
            // Modify existing jabatans table
            Schema::table('jabatans', function (Blueprint $table) {
                if (!Schema::hasColumn('jabatans', 'nama_jabatan')) {
                    $table->string('nama_jabatan')->after('lembaga_id');
                }
                if (!Schema::hasColumn('jabatans', 'level')) {
                    $table->string('level')->after('nama_jabatan');
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
