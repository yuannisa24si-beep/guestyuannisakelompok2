<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard guest.
     */
    public function index()
    {
        return view('guest.dasboard');
        // 1. Ambil Total Jumlah Warga
        $totalWarga = Warga::count();

        // 2. Ambil 5 Data Warga Terbaru
        $recentWarga = Warga::orderBy('created_at', 'desc')->limit(5)->get(); // Urutkan terbaru, ambil 5

        // Kirim data ke view guest.dasboard
        return view('guest.dasboard', compact('totalWarga', 'recentWarga'));
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
