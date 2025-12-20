<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use App\Models\PerangkatDesa;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\AnggotaLembaga;
use App\Models\Warga;
use Illuminate\Http\Request;

class DataCardController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $lembagaDesa = LembagaDesa::with('jabatans')->get();
        $perangkatDesa = PerangkatDesa::with('warga')->get();
        $rw = Rw::with('ketuaRw')->get();
        $rt = Rt::with(['rw', 'ketuaRt'])->get();
        $anggotaLembaga = AnggotaLembaga::with(['lembaga', 'warga', 'jabatan'])->get();

        return view('data-cards', compact('lembagaDesa', 'perangkatDesa', 'rw', 'rt', 'anggotaLembaga'));
    }
}



