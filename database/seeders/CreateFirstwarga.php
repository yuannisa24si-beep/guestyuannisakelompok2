<?php

namespace Database\Seeders;
use App\Models\warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class Createwarga extends Seeder
{
    public function run(): void
    {
      // Akun Admin yang mudah diuji
      warga::create([
            'nama'=>'guest',
            'email'=>'guest@mail.com', // 💡 EMAIL UNTUK UJI COBA
            'password'=> Hash::make('password'), // 💡 PASSWORD UNTUK UJI COBA
            'nik' => '9876543210987654',
            'alamat' => 'Jalan guest',
            'telepon' => '082171223978',
            'role' => 'admin'
      ]);
      
      // Akun Warga
      warga::create([
            'nama'=>'Yuannisa', 
            'email'=>'yuannisa24si@mahasiswa.pcr.ac.id',
            'password'=> Hash::make('yuannisa16'), 
            'nik' => '1234567890123456', 
            'alamat' => 'Jalan Kenangan', 
            'telepon' => '081234567890', 
            'role' => 'warga' 
      ]);
    }
}