<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;

    protected $table = 'perangkat_desa';
    protected $primaryKey = 'perangkat_id';

    protected $fillable = [
        'warga_id',
        'jabatan',
        'nip',
        'kontak',
        'periode_mulai',
        'periode_selesai',
        'foto'
    ];

    protected $casts = [
        'periode_mulai' => 'date',
        'periode_selesai' => 'date',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}