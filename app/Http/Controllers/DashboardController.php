<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\User;
use App\Models\LembagaDesa;
use App\Models\PerangkatDesa;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Jabatan;
use App\Models\AnggotaLembaga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard public dengan statistik.
     */
    public function index()
    {
        try {
            // Ambil semua statistik dari database dengan error handling
            $totalWarga = Warga::count();
            $totalUser = User::count();
            $totalLembagaDesa = LembagaDesa::count();
            $totalPerangkatDesa = PerangkatDesa::count();
            $totalRt = Rt::count();
            $totalRw = Rw::count();
            $totalJabatan = Jabatan::count();
            $totalAnggotaLembaga = AnggotaLembaga::count();
        } catch (\Exception $e) {
            // Jika ada error, set semua ke 0
            $totalWarga = 0;
            $totalUser = 0;
            $totalLembagaDesa = 0;
            $totalPerangkatDesa = 0;
            $totalRt = 0;
            $totalRw = 0;
            $totalJabatan = 0;
            $totalAnggotaLembaga = 0;
        }

        // Kirim data ke view
        return view('dashboard-public', compact(
            'totalWarga',
            'totalUser',
            'totalLembagaDesa',
            'totalPerangkatDesa',
            'totalRt',
            'totalRw',
            'totalJabatan',
            'totalAnggotaLembaga'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
