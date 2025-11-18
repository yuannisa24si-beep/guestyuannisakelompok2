<?php

namespace App\Http\Controllers;

use App\Models\Warga; // Import Model Warga
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Menampilkan daftar semua warga (READ).
     */
    public function index()
    {
        $wargas = Warga::all();
        return view('admin.warga.index', compact('wargas'));
    }

    /**
     * Menampilkan formulir untuk membuat warga baru (CREATE - Form).
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Menyimpan warga yang baru dibuat ke database (CREATE - Store).
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:warga,nik',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
        ]);

        Warga::create($validatedData);

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit warga (UPDATE - Form).
     */
    public function edit(Warga $warga) // Menggunakan Route Model Binding
    {
        return view('admin.warga.edit', compact('warga'));
    }

    /**
     * Memperbarui warga yang sudah ada di database (UPDATE - Store).
     */
    public function update(Request $request, Warga $warga)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:warga,nik,' . $warga->warga_id . ',warga_id', // Abaikan NIK warga saat ini
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
        ]);

        $warga->update($validatedData);

        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil diperbarui!');
    }

    /**
     * Menghapus warga dari database (DELETE).
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil dihapus!');
    }
    
    // show() tidak perlu diimplementasikan untuk CRUD sederhana
    public function show(string $id) { /* Kosongkan atau hapus */ } 
}