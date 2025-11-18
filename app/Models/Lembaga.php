<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'lembaga';

    // Kunci utama (Primary Key)
    protected $primaryKey = 'lembaga_id';

    // Field yang dapat diisi massal
    protected $fillable = [
        'nama_lembaga',
        'alamat',
    ];

    /**
     * Mendefinisikan relasi: Setiap Lembaga memiliki banyak Jabatan.
     */
    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'lembaga_id', 'lembaga_id');
    }
}