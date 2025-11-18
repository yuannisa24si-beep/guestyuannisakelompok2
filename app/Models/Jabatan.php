<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jabatan_lembaga';

    // Kunci utama (Primary Key)
    protected $primaryKey = 'jabatan_id';

    // Field yang dapat diisi massal
    protected $fillable = [
        'lembaga_id',
        'nama_jabatan',
        'level',
        'deskripsi',
    ];

    /**
     * Mendefinisikan relasi: Setiap Jabatan dimiliki oleh satu Lembaga.
     */
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id', 'lembaga_id');
    }
}