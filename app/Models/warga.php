<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'warga';

    // Kunci utama (Primary Key)
    protected $primaryKey = 'warga_id';

    protected $string = 'telepon';
    
    // Field yang dapat diisi massal
    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'telepon',
    ];
}