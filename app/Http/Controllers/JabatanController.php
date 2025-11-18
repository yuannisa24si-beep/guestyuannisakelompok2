<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Menampilkan daftar jabatan untuk halaman publik. (READ Front-end)
     */
    public function publicIndex()
    {
        // Ambil semua jabatan beserta nama lembaganya
        $jabatans = Jabatan::with('lembaga')->orderBy('level')->get();
        
        // Merujuk ke resources/views/jabatan/jabatan.blade.php
        return view('jabatan.jabatan', compact('jabatans')); 
    }

    /**
     * Menampilkan daftar semua jabatan untuk panel admin. (READ Admin)
     */
    public function index()
    {
        $jabatans = Jabatan::with('lembaga')->orderBy('level')->get();
        // Merujuk ke resources/views/admin/jabatan/index.blade.php
        return view('admin.jabatan.index', compact('jabatans'));
    }

    /**
     * Menampilkan formulir untuk membuat jabatan baru. (CREATE - Form)
     */
    public function create()
    {
        $lembagaList = Lembaga::all();
        // Merujuk ke resources/views/admin/jabatan/create.blade.php
        return view('admin.jabatan.create', compact('lembagaList'));
    }

    /**
     * Menyimpan jabatan yang baru dibuat ke database. (CREATE - Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'lembaga_id' => 'required|exists:lembaga,lembaga_id',
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Simpan ke database
        Jabatan::create($validatedData);

        return redirect()->route('jabatan.crud.index')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir untuk mengedit jabatan yang sudah ada. (UPDATE - Form)
     */
    public function edit(Jabatan $jabatan)
    {
        $lembagaList = Lembaga::all();
        // Merujuk ke resources/views/admin/jabatan/edit.blade.php
        return view('admin.jabatan.edit', compact('jabatan', 'lembagaList'));
    }

    /**
     * Memperbarui jabatan yang sudah ada di database. (UPDATE - Store)
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'lembaga_id' => 'required|exists:lembaga,lembaga_id',
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Perbarui database
        $jabatan->update($validatedData);

        return redirect()->route('jabatan.crud.index')->with('success', 'Jabatan berhasil diperbarui!');
    }

    /**
     * Menghapus jabatan dari database. (DELETE)
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect()->route('jabatan.crud.index')->with('success', 'Jabatan berhasil dihapus!');
    }
}