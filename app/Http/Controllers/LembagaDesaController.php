<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    /**
     * Tampilkan halaman public - hanya view data
     */
    public function publicIndex()
    {
        try {
            $lembagaDesa = LembagaDesa::with('jabatans', 'anggotaLembaga')->get();
        } catch (\Exception $e) {
            $lembagaDesa = collect([]);
        }
        return view('public.lembaga-desa', compact('lembagaDesa'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = LembagaDesa::with('jabatans');
        
        if ($search) {
            $query->where('nama_lembaga', 'LIKE', '%' . $search . '%')
                  ->orWhere('alamat', 'LIKE', '%' . $search . '%');
        }
        
        $lembagaDesa = $query->paginate(15);
        
        return view('admin.lembaga-desa.index', compact('lembagaDesa', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lembaga-desa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        LembagaDesa::create($validated);

        return redirect()->route('lembaga-desa.crud.index')
            ->with('success', 'Lembaga Desa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LembagaDesa $lembagaDesa)
    {
        $lembagaDesa->load('jabatans', 'anggotaLembaga');
        return view('admin.lembaga-desa.show', compact('lembagaDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LembagaDesa $lembagaDesa)
    {
        return view('admin.lembaga-desa.edit', compact('lembagaDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LembagaDesa $lembagaDesa)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $lembagaDesa->update($validated);

        return redirect()->route('lembaga-desa.crud.index')
            ->with('success', 'Lembaga Desa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LembagaDesa $lembagaDesa)
    {
        $lembagaDesa->delete();

        return redirect()->route('lembaga-desa.crud.index')
            ->with('success', 'Lembaga Desa berhasil dihapus!');
    }
}

