<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaLembaga extends Model
{
    use HasFactory;

    protected $table = 'anggota_lembaga';
    protected $primaryKey = 'anggota_id';

    protected $fillable = [
        'lembaga_id',
        'warga_id',
        'jabatan_id',
        'tgl_mulai',
        'tgl_selesai'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
    ];

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id', 'lembaga_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }
}