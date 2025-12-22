<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rw';
    protected $primaryKey = 'rw_id';

    protected $fillable = [
        'nomor_rw',
        'ketua_rw_warga_id',
        'keterangan'
    ];

    public function ketuaRw()
    {
        return $this->belongsTo(Warga::class, 'ketua_rw_warga_id', 'warga_id');
    }

    public function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id', 'rw_id');
    }
}