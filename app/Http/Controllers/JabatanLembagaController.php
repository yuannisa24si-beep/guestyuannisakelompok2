<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JabatanLembaga;

class JabatanLembagaController extends Controller
{
    /**
     * Tampilkan semua data jabatan lembaga
     */
    public function index()
    {
        $jabatanLembagas = JabatanLembaga::all();
        return view('guest.jabatanlembaga.index', compact('jabatanLembagas'));
    }

    /**
     * Tampilkan form tambah jabatan lembaga
     */
    public function create()
    {
        return view('guest.jabatanlembaga.create');
    }

    /**
     * Simpan data jabatan lembaga baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ]);

        JabatanLembaga::create($request->all());

        return redirect()->route('jabatanlembaga.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit jabatan lembaga
     */
    public function edit($id)
    {
        $jabatanLembaga = JabatanLembaga::findOrFail($id);
        return view('guest.jabatanlembaga.edit', compact('jabatanLembaga'));
    }

    /**
     * Update data jabatan lembaga
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ]);

        $jabatanLembaga = JabatanLembaga::findOrFail($id);
        $jabatanLembaga->update($request->all());

        return redirect()->route('jabatanlembaga.index')
            ->with('success', 'Data berhasil diubah.');
    }

    /**
     * Hapus data jabatan lembaga
     */
    public function destroy($id)
    {
        JabatanLembaga::destroy($id);

        return redirect()->route('jabatanlembaga.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
