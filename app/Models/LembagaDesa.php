<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'lembaga_desa';

    // Kunci utama (Primary Key)
    protected $primaryKey = 'lembaga_id';

    // Field yang dapat diisi massal
    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
    ];

    /**
     * Mendefinisikan relasi: Setiap Lembaga memiliki banyak Jabatan.
     */
    public function jabatans()
    {
        return $this->hasMany(Jabatan::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * Mendefinisikan relasi: Setiap Lembaga memiliki banyak Anggota Lembaga.
     */
    public function anggotaLembaga()
    {
        return $this->hasMany(AnggotaLembaga::class, 'lembaga_id', 'lembaga_id');
    }
}

// Alias untuk kompatibilitas dengan kode lama
class Lembaga extends LembagaDesa
{
}