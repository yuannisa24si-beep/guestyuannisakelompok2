<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample lembaga data
        $lembagas = [
            [
                'lembaga_id' => 1,
                'nama_lembaga' => 'Badan Permusyawaratan Desa (BPD)',
                'alamat' => 'Jl. Desa Maju No. 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'lembaga_id' => 2,
                'nama_lembaga' => 'Lembaga Pemberdayaan Masyarakat (LPM)',
                'alamat' => 'Jl. Desa Maju No. 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'lembaga_id' => 3,
                'nama_lembaga' => 'Pemberdayaan Kesejahteraan Keluarga (PKK)',
                'alamat' => 'Jl. Desa Maju No. 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'lembaga_id' => 4,
                'nama_lembaga' => 'Karang Taruna',
                'alamat' => 'Jl. Desa Maju No. 4',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('lembaga')->insert($lembagas);
        
        // Insert sample jabatan data
        $jabatans = [
            [
                'jabatan_id' => 1,
                'lembaga_id' => 1,
                'nama_jabatan' => 'Ketua BPD',
                'level' => 1,
                'deskripsi' => 'Memimpin Badan Permusyawaratan Desa',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 2,
                'lembaga_id' => 1,
                'nama_jabatan' => 'Sekretaris BPD',
                'level' => 2,
                'deskripsi' => 'Mengelola administrasi BPD',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 3,
                'lembaga_id' => 2,
                'nama_jabatan' => 'Ketua LPM',
                'level' => 1,
                'deskripsi' => 'Memimpin Lembaga Pemberdayaan Masyarakat',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 4,
                'lembaga_id' => 3,
                'nama_jabatan' => 'Ketua PKK',
                'level' => 1,
                'deskripsi' => 'Memimpin Tim Penggerak PKK',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('jabatan_lembaga')->insert($jabatans);
        
        // Insert sample warga data
        $wargas = [
            [
                'warga_id' => 1,
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'nik' => '3201234567890001',
                'alamat' => 'Jl. Merdeka No. 10',
                'telepon' => '081234567890',
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'warga_id' => 2,
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'password' => Hash::make('password'),
                'nik' => '3201234567890002',
                'alamat' => 'Jl. Proklamasi No. 15',
                'telepon' => '081234567891',
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'warga_id' => 3,
                'nama' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.com',
                'password' => Hash::make('password'),
                'nik' => '3201234567890003',
                'alamat' => 'Jl. Pancasila No. 20',
                'telepon' => '081234567892',
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'warga_id' => 4,
                'nama' => 'Dewi Sartika',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password'),
                'nik' => '3201234567890004',
                'alamat' => 'Jl. Diponegoro No. 25',
                'telepon' => '081234567893',
                'role' => 'warga',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('warga')->insert($wargas);
        
        // Insert sample RW data
        $rws = [
            [
                'rw_id' => 1,
                'nomor_rw' => '001',
                'ketua_rw_warga_id' => 1,
                'keterangan' => 'RW 001 - Wilayah Jl. Merdeka',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rw_id' => 2,
                'nomor_rw' => '002',
                'ketua_rw_warga_id' => 2,
                'keterangan' => 'RW 002 - Wilayah Jl. Proklamasi',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('rw')->insert($rws);
        
        // Insert sample RT data
        $rts = [
            [
                'rt_id' => 1,
                'rw_id' => 1,
                'nomor_rt' => '001',
                'ketua_rt_warga_id' => 3,
                'keterangan' => 'RT 001 RW 001 - Jl. Merdeka 1-25',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rt_id' => 2,
                'rw_id' => 2,
                'nomor_rt' => '001',
                'ketua_rt_warga_id' => 4,
                'keterangan' => 'RT 001 RW 002 - Jl. Proklamasi 1-25',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('rt')->insert($rts);
        
        // Insert sample perangkat desa data
        $perangkats = [
            [
                'perangkat_id' => 1,
                'warga_id' => 1,
                'jabatan' => 'Kepala Desa',
                'nip' => '196501011990031001',
                'kontak' => '081234567890',
                'periode_mulai' => '2024-01-01',
                'periode_selesai' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'perangkat_id' => 2,
                'warga_id' => 2,
                'jabatan' => 'Sekretaris Desa',
                'nip' => '196502021990032002',
                'kontak' => '081234567891',
                'periode_mulai' => '2024-01-01',
                'periode_selesai' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('perangkat_desa')->insert($perangkats);
        
        // Insert sample anggota lembaga data
        $anggotas = [
            [
                'anggota_id' => 1,
                'lembaga_id' => 1,
                'warga_id' => 1,
                'jabatan_id' => 1,
                'tgl_mulai' => '2024-01-01',
                'tgl_selesai' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'anggota_id' => 2,
                'lembaga_id' => 2,
                'warga_id' => 2,
                'jabatan_id' => 3,
                'tgl_mulai' => '2024-01-01',
                'tgl_selesai' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        DB::table('anggota_lembaga')->insert($anggotas);
        
        echo "Sample data inserted successfully!\n";
    }
}
