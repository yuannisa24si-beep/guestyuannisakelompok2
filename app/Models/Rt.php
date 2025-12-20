<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'rt_id';

    protected $fillable = [
        'rw_id',
        'nomor_rt',
        'ketua_rt_warga_id',
        'keterangan'
    ];

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'rw_id');
    }

    public function ketuaRt()
    {
        return $this->belongsTo(Warga::class, 'ketua_rt_warga_id', 'warga_id');
    }
}