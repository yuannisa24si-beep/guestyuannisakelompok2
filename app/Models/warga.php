<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Warga extends Authenticatable 
{
    use HasFactory;
    // ... properti lainnya
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    
    protected $fillable = [
        'nama', 
        'email', 
        'password', 
        'nik', 
        'alamat', 
        'telepon', 
        'role'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Ini diperlukan agar model berfungsi penuh sebagai user
    public function getAuthPassword()
    {
        return ''; 
    }
}