<?php

namespace App\Http\Controllers;

use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\Jabatan;
use App\Models\Warga;
use Illuminate\Http\Request;

class AnggotaLembagaController extends Controller
{
    /**
     * Tampilkan halaman public - hanya view data
     */
    public function publicIndex()
    {
        try {
            $anggotaLembaga = AnggotaLembaga::with(['lembaga', 'warga', 'jabatan'])->get();
        } catch (\Exception $e) {
            $anggotaLembaga = collect([]);
        }
        return view('public.anggota-lembaga', compact('anggotaLembaga'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $lembagaId = $request->input('lembaga_id');
        
        $query = AnggotaLembaga::with(['lembaga', 'warga', 'jabatan']);
        
        if ($search) {
            $query->whereHas('warga', function($q) use ($search) {
                      $q->where('nama', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('lembaga', function($q) use ($search) {
                      $q->where('nama_lembaga', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('jabatan', function($q) use ($search) {
                      $q->where('nama_jabatan', 'LIKE', '%' . $search . '%');
                  });
        }
        
        if ($lembagaId) {
            $query->where('lembaga_id', $lembagaId);
        }
        
        $anggotaLembaga = $query->paginate(15);
        $lembaga = LembagaDesa::all();
        
        return view('admin.anggota-lembaga.index', compact('anggotaLembaga', 'lembaga', 'search', 'lembagaId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lembaga = LembagaDesa::all();
        $warga = Warga::all();
        $jabatan = Jabatan::all();
        return view('admin.anggota-lembaga.create', compact('lembaga', 'warga', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lembaga_id' => 'required|exists:lembaga,lembaga_id',
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan_id' => 'required|exists:jabatan_lembaga,jabatan_id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date|after:tgl_mulai',
        ]);

        // Check for overlapping period
        if (AnggotaLembaga::hasOverlappingPeriod(
            $validated['warga_id'],
            $validated['lembaga_id'],
            $validated['jabatan_id'],
            $validated['tgl_mulai'],
            $validated['tgl_selesai'] ?? null
        )) {
            return back()->withErrors(['tgl_mulai' => 'Periode ini bertabrakan dengan periode yang sudah ada.'])->withInput();
        }

        AnggotaLembaga::create($validated);

        return redirect()->route('anggota-lembaga.crud.index')
            ->with('success', 'Anggota Lembaga berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaLembaga $anggotaLembaga)
    {
        $lembaga = LembagaDesa::all();
        $warga = Warga::all();
        $jabatan = Jabatan::all();
        return view('admin.anggota-lembaga.edit', compact('anggotaLembaga', 'lembaga', 'warga', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaLembaga $anggotaLembaga)
    {
        $validated = $request->validate([
            'lembaga_id' => 'required|exists:lembaga,lembaga_id',
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan_id' => 'required|exists:jabatan_lembaga,jabatan_id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'nullable|date|after:tgl_mulai',
        ]);

        // Check for overlapping period (exclude current record)
        if (AnggotaLembaga::hasOverlappingPeriod(
            $validated['warga_id'],
            $validated['lembaga_id'],
            $validated['jabatan_id'],
            $validated['tgl_mulai'],
            $validated['tgl_selesai'] ?? null,
            $anggotaLembaga->anggota_id
        )) {
            return back()->withErrors(['tgl_mulai' => 'Periode ini bertabrakan dengan periode yang sudah ada.'])->withInput();
        }

        $anggotaLembaga->update($validated);

        return redirect()->route('anggota-lembaga.crud.index')
            ->with('success', 'Anggota Lembaga berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaLembaga $anggotaLembaga)
    {
        $anggotaLembaga->delete();

        return redirect()->route('anggota-lembaga.crud.index')
            ->with('success', 'Anggota Lembaga berhasil dihapus!');
    }
}

