<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga'; 
    protected $primaryKey = 'lembaga_id';
    
    protected $fillable = [
        'nama_lembaga',
        'alamat',
    ];

    
    public function jabatans()
    {
        return $this->hasMany(Jabatan::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * Relasi ke Anggota Lembaga
     */
    public function anggotaLembaga()
    {
        return $this->hasMany(AnggotaLembaga::class, 'lembaga_id', 'lembaga_id');
    }
}