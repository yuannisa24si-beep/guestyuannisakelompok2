<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Membuat data sesuai dengan jumlah di admin panel:
     * - 100 Warga
     * - 19 Jabatan  
     * - 20 Lembaga
     * - 20 Perangkat Desa
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('anggota_lembaga')->delete();
        DB::table('perangkat_desa')->delete();
        DB::table('rt')->delete();
        DB::table('rw')->delete();
        DB::table('jabatan_lembaga')->delete();
        DB::table('lembaga')->delete();
        DB::table('warga')->delete();
        
        echo "Creating data to match admin panel...\n";
        
        // 1. Create 20 Lembaga (sesuai admin panel)
        $lembagas = [];
        $lembagaNames = [
            'Badan Permusyawaratan Desa (BPD)',
            'Lembaga Pemberdayaan Masyarakat (LPM)', 
            'Pemberdayaan Kesejahteraan Keluarga (PKK)',
            'Karang Taruna',
            'Rukun Tetangga (RT)',
            'Rukun Warga (RW)',
            'Lembaga Adat Desa',
            'Kelompok Tani',
            'Koperasi Desa',
            'Bumdes (Badan Usaha Milik Desa)',
            'Posyandu',
            'Kelompok Informasi Masyarakat (KIM)',
            'Tim Penggerak PKK Desa',
            'Kelompok Sadar Wisata (Pokdarwis)',
            'Lembaga Ekonomi Desa',
            'Forum Anak Desa',
            'Kelompok Wanita Tani (KWT)',
            'Gapoktan (Gabungan Kelompok Tani)',
            'Lembaga Keuangan Mikro Desa',
            'Tim Pelaksana Kegiatan Desa'
        ];
        
        for ($i = 1; $i <= 20; $i++) {
            $lembagas[] = [
                'lembaga_id' => $i,
                'nama_lembaga' => $lembagaNames[$i-1],
                'alamat' => 'Jl. Desa Maju No. ' . $i,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5))
            ];
        }
        DB::table('lembaga')->insert($lembagas);
        echo "✓ Created 20 Lembaga\n";
        
        // 2. Create 19 Jabatan (sesuai admin panel)
        $jabatans = [];
        $jabatanNames = [
            'Kepala Desa', 'Sekretaris Desa', 'Bendahara Desa',
            'Kepala Urusan Pemerintahan', 'Kepala Urusan Pembangunan', 'Kepala Urusan Kesejahteraan Rakyat',
            'Ketua BPD', 'Wakil Ketua BPD', 'Sekretaris BPD',
            'Ketua LPM', 'Sekretaris LPM', 'Bendahara LPM',
            'Ketua PKK', 'Wakil Ketua PKK', 'Sekretaris PKK',
            'Ketua Karang Taruna', 'Wakil Ketua Karang Taruna',
            'Kepala Dusun I', 'Kepala Dusun II'
        ];
        
        for ($i = 1; $i <= 19; $i++) {
            $jabatans[] = [
                'jabatan_id' => $i,
                'lembaga_id' => rand(1, 20),
                'nama_jabatan' => $jabatanNames[$i-1],
                'level' => rand(1, 3),
                'deskripsi' => 'Deskripsi jabatan ' . $jabatanNames[$i-1],
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5))
            ];
        }
        DB::table('jabatan_lembaga')->insert($jabatans);
        echo "✓ Created 19 Jabatan\n";
        
        // 3. Create 100 Warga (sesuai admin panel) - batch insert
        echo "Creating 100 Warga...\n";
        $namaDepan = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fitri', 'Galih', 'Hani', 'Indra', 'Joko'];
        $namaBelakang = ['Santoso', 'Wijaya', 'Sari', 'Putri', 'Pratama', 'Lestari', 'Nugroho', 'Rahayu', 'Setiawan', 'Maharani'];
        
        // Insert in batches of 20
        for ($batch = 0; $batch < 5; $batch++) {
            $wargas = [];
            for ($i = 1; $i <= 20; $i++) {
                $id = ($batch * 20) + $i;
                $namaDepanRand = $namaDepan[array_rand($namaDepan)];
                $namaBelakangRand = $namaBelakang[array_rand($namaBelakang)];
                
                $wargas[] = [
                    'warga_id' => $id,
                    'nama' => $namaDepanRand . ' ' . $namaBelakangRand . ' ' . $id,
                    'email' => strtolower($namaDepanRand . $namaBelakangRand . $id) . '@example.com',
                    'password' => Hash::make('password'),
                    'nik' => '32010' . str_pad($id, 11, '0', STR_PAD_LEFT),
                    'alamat' => 'Jl. Merdeka No. ' . $id . ', RT 00' . (($id % 5) + 1) . '/RW 00' . (($id % 3) + 1),
                    'telepon' => '0812345' . str_pad($id, 5, '0', STR_PAD_LEFT),
                    'role' => ($id <= 5) ? 'admin' : 'warga',
                    'created_at' => now()->subDays(rand(1, 60)),
                    'updated_at' => now()->subDays(rand(0, 10))
                ];
            }
            DB::table('warga')->insert($wargas);
            echo "  ✓ Batch " . ($batch + 1) . "/5 completed\n";
        }
        echo "✓ Created 100 Warga\n";
        
        // 4. Create 20 Perangkat Desa (sesuai admin panel)
        $perangkats = [];
        for ($i = 1; $i <= 20; $i++) {
            $perangkats[] = [
                'perangkat_id' => $i,
                'warga_id' => $i, // Menggunakan 20 warga pertama
                'jabatan' => $jabatanNames[($i-1) % 19], // Rotate jabatan
                'nip' => '196' . str_pad($i, 2, '0', STR_PAD_LEFT) . '01011990031' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'kontak' => '0812345' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'periode_mulai' => '2024-01-01',
                'periode_selesai' => null,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5))
            ];
        }
        DB::table('perangkat_desa')->insert($perangkats);
        echo "✓ Created 20 Perangkat Desa\n";
        
        // 5. Create RW dan RT
        $rws = [];
        for ($i = 1; $i <= 5; $i++) {
            $rws[] = [
                'rw_id' => $i,
                'nomor_rw' => str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketua_rw_warga_id' => $i + 20, // Warga 21-25
                'keterangan' => 'RW ' . str_pad($i, 3, '0', STR_PAD_LEFT) . ' - Wilayah Desa Maju',
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5))
            ];
        }
        DB::table('rw')->insert($rws);
        echo "✓ Created 5 RW\n";
        
        $rts = [];
        for ($i = 1; $i <= 15; $i++) {
            $rts[] = [
                'rt_id' => $i,
                'rw_id' => (($i - 1) % 5) + 1, // Distribute RT across RW
                'nomor_rt' => str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketua_rt_warga_id' => $i + 25, // Warga 26-40
                'keterangan' => 'RT ' . str_pad($i, 3, '0', STR_PAD_LEFT) . ' - Area Perumahan',
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5))
            ];
        }
        DB::table('rt')->insert($rts);
        echo "✓ Created 15 RT\n";
        
        // 6. Create Anggota Lembaga
        $anggotas = [];
        for ($i = 1; $i <= 30; $i++) {
            $anggotas[] = [
                'anggota_id' => $i,
                'lembaga_id' => rand(1, 20),
                'warga_id' => rand(1, 100),
                'jabatan_id' => rand(1, 19),
                'tgl_mulai' => now()->subDays(rand(30, 365))->format('Y-m-d'),
                'tgl_selesai' => (rand(1, 10) > 7) ? now()->addDays(rand(30, 365))->format('Y-m-d') : null,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5))
            ];
        }
        DB::table('anggota_lembaga')->insert($anggotas);
        echo "✓ Created 30 Anggota Lembaga\n";
        
        echo "\n=== DATA SEEDED SUCCESSFULLY ===\n";
        echo "Data now matches admin panel:\n";
        echo "- 100 Warga ✓\n";
        echo "- 19 Jabatan ✓\n"; 
        echo "- 20 Lembaga ✓\n";
        echo "- 20 Perangkat Desa ✓\n";
        echo "- 5 RW ✓\n";
        echo "- 15 RT ✓\n";
        echo "- 30 Anggota Lembaga ✓\n";
    }
}