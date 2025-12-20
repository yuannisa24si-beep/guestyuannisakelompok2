<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;

class RtController extends Controller
{
    /**
     * Tampilkan halaman public - hanya view data
     */
    public function publicIndex()
    {
        try {
            $rt = Rt::with('rw', 'ketuaRt')->get();
        } catch (\Exception $e) {
            $rt = collect([]);
        }
        return view('public.rt', compact('rt'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $rwId = $request->input('rw_id');
        
        $query = Rt::with('rw', 'ketuaRt');
        
        if ($search) {
            $query->where('nomor_rt', 'LIKE', '%' . $search . '%')
                  ->orWhere('keterangan', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('rw', function($q) use ($search) {
                      $q->where('nomor_rw', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('ketuaRt', function($q) use ($search) {
                      $q->where('nama', 'LIKE', '%' . $search . '%');
                  });
        }
        
        if ($rwId) {
            $query->where('rw_id', $rwId);
        }
        
        $rt = $query->paginate(15);
        $rw = Rw::all();
        
        return view('admin.rt.index', compact('rt', 'rw', 'search', 'rwId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rw = Rw::all();
        $warga = Warga::all();
        return view('admin.rt.create', compact('rw', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rw_id' => 'required|exists:rw,rw_id',
            'nomor_rt' => 'required|string|max:255',
            'ketua_rt_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string',
        ]);

        Rt::create($validated);

        return redirect()->route('rt.crud.index')
            ->with('success', 'Data RT berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rt $rt)
    {
        $rw = Rw::all();
        $warga = Warga::all();
        return view('admin.rt.edit', compact('rt', 'rw', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rt $rt)
    {
        $validated = $request->validate([
            'rw_id' => 'required|exists:rw,rw_id',
            'nomor_rt' => 'required|string|max:255',
            'ketua_rt_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string',
        ]);

        $rt->update($validated);

        return redirect()->route('rt.crud.index')
            ->with('success', 'Data RT berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rt $rt)
    {
        $rt->delete();

        return redirect()->route('rt.crud.index')
            ->with('success', 'Data RT berhasil dihapus!');
    }
}

