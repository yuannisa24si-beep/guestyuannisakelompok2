<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jabatans';

    // Kunci utama (Primary Key)
    protected $primaryKey = 'id';

    // Field yang dapat diisi massal
    protected $fillable = [
        'lembaga_id',
        'nama_jabatan',
        'level',
    ];

    /**
     * Mendefinisikan relasi: Setiap Jabatan dimiliki oleh satu Lembaga.
     */
    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * Mendefinisikan relasi: Setiap Jabatan memiliki banyak Anggota Lembaga.
     */
    public function anggotaLembaga()
    {
        return $this->hasMany(AnggotaLembaga::class, 'jabatan_id', 'id');
    }
}