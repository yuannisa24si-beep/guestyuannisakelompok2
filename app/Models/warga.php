<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// 💡 PASTIKAN BARIS INI DIGUNAKAN
use Illuminate\Foundation\Auth\User as Authenticatable; 

// 💡 PASTIKAN BERGANTI KE Authenticatable
class Warga extends Authenticatable 
{
    use HasFactory;
    // ... properti lainnya
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    
    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'telepon',
        'role',
    ];
    
    // Ini diperlukan agar model berfungsi penuh sebagai user
    public function getAuthPassword()
    {
        return ''; 
    }
}