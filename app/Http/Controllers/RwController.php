<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;

class RwController extends Controller
{
    /**
     * Tampilkan halaman public - hanya view data
     */
    public function publicIndex()
    {
        try {
            $rw = Rw::with('ketuaRw', 'rts')->get();
        } catch (\Exception $e) {
            $rw = collect([]);
        }
        return view('public.rw', compact('rw'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Rw::with('ketuaRw', 'rts');
        
        if ($search) {
            $query->where('nomor_rw', 'LIKE', '%' . $search . '%')
                  ->orWhere('keterangan', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('ketuaRw', function($q) use ($search) {
                      $q->where('nama', 'LIKE', '%' . $search . '%');
                  });
        }
        
        $rw = $query->paginate(15);
        
        return view('admin.rw.index', compact('rw', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::all();
        return view('admin.rw.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rw' => 'required|string|max:255|unique:rw,nomor_rw',
            'ketua_rw_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string',
        ]);

        Rw::create($validated);

        return redirect()->route('rw.crud.index')
            ->with('success', 'Data RW berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rw $rw)
    {
        $warga = Warga::all();
        return view('admin.rw.edit', compact('rw', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rw $rw)
    {
        $validated = $request->validate([
            'nomor_rw' => 'required|string|max:255|unique:rw,nomor_rw,' . $rw->rw_id . ',rw_id',
            'ketua_rw_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string',
        ]);

        $rw->update($validated);

        return redirect()->route('rw.crud.index')
            ->with('success', 'Data RW berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rw $rw)
    {
        $rw->delete();

        return redirect()->route('rw.crud.index')
            ->with('success', 'Data RW berhasil dihapus!');
    }
}

