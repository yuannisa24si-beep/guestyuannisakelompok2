<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;
    
    protected $table = 'wargas';
    protected $primaryKey = 'warga_id';
    
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
        'foto_profil_path',
    ];

    /**
     * Relasi: Warga memiliki banyak File
     */
    public function files()
    {
        return $this->hasMany(WargaFiles::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi: Warga memiliki banyak Anggota Lembaga
     */
    public function anggotaLembaga()
    {
        return $this->hasMany(AnggotaLembaga::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi: Warga memiliki banyak Perangkat Desa
     */
    public function perangkatDesa()
    {
        return $this->hasMany(PerangkatDesa::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi: Warga menjadi ketua RW
     */
    public function rwAsKetua()
    {
        return $this->hasMany(Rw::class, 'ketua_rw_warga_id', 'warga_id');
    }

    /**
     * Relasi: Warga menjadi ketua RT
     */
    public function rtAsKetua()
    {
        return $this->hasMany(Rt::class, 'ketua_rt_warga_id', 'warga_id');
    }
}