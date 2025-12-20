<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    /**
     * Tampilkan halaman public - hanya view data
     */
    public function publicIndex()
    {
        try {
            $perangkatDesa = PerangkatDesa::with('warga')->get();
        } catch (\Exception $e) {
            $perangkatDesa = collect([]);
        }
        return view('public.perangkat-desa', compact('perangkatDesa'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = PerangkatDesa::with('warga');
        
        if ($search) {
            $query->where('jabatan', 'LIKE', '%' . $search . '%')
                  ->orWhere('nip', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('warga', function($q) use ($search) {
                      $q->where('nama', 'LIKE', '%' . $search . '%');
                  });
        }
        
        $perangkatDesa = $query->paginate(15);
        
        return view('admin.perangkat-desa.index', compact('perangkatDesa', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::all();
        return view('admin.perangkat-desa.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('perangkat_desa', 'public');
        }

        PerangkatDesa::create($validated);

        return redirect()->route('perangkat-desa.crud.index')
            ->with('success', 'Perangkat Desa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerangkatDesa $perangkatDesa)
    {
        $warga = Warga::all();
        return view('admin.perangkat-desa.edit', compact('perangkatDesa', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerangkatDesa $perangkatDesa)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($perangkatDesa->foto) {
                \Storage::disk('public')->delete($perangkatDesa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('perangkat_desa', 'public');
        }

        $perangkatDesa->update($validated);

        return redirect()->route('perangkat-desa.crud.index')
            ->with('success', 'Perangkat Desa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerangkatDesa $perangkatDesa)
    {
        if ($perangkatDesa->foto) {
            \Storage::disk('public')->delete($perangkatDesa->foto);
        }
        
        $perangkatDesa->delete();

        return redirect()->route('perangkat-desa.crud.index')
            ->with('success', 'Perangkat Desa berhasil dihapus!');
    }
}

