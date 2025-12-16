<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lembaga')->insert([
            [
                'lembaga_id' => 1,
                'nama_lembaga' => 'Pemerintah Desa',
                'alamat' => 'Kantor Desa Pusat',
                'telepon' => '080012345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lembaga_id' => 2,
                'nama_lembaga' => 'BUMDes',
                'alamat' => 'Kantor BUMDes',
                'telepon' => '080012345679',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
