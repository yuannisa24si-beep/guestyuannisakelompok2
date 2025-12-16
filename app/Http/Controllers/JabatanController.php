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
    public function publicIndex(Request $request)
    {
        $search = $request->input('search');

        // Mulai query Jabatan, sertakan relasi lembaga
        $jabatans = Jabatan::with('lembaga')->orderBy('nama_jabatan', 'asc');

        // Tambahkan kondisi WHERE jika ada kata kunci pencarian
        if ($search) {
            $jabatans->where('nama_jabatan', 'LIKE', '%' . $search . '%')
                     ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        }

        // Terapkan pagination
        $jabatans = $jabatans->Simplepaginate(15); 
        
        // Asumsi view publik Anda adalah 'jabatan.index_public'
        return view('jabatan.index_public', compact('jabatans', 'search'));
    }

    /**
     * Menampilkan daftar semua jabatan untuk panel admin. (READ Admin)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mulai query Jabatan, sertakan relasi lembaga
        $jabatans = Jabatan::with('lembaga')->orderBy('nama_jabatan', 'asc');

        // Tambahkan kondisi WHERE jika ada kata kunci pencarian
        if ($search) {
            $jabatans->where('nama_jabatan', 'LIKE', '%' . $search . '%')
                     ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
                     // Anda juga bisa menambahkan orWhereHas jika ingin mencari berdasarkan nama lembaga
        }

        // Terapkan pagination
        $jabatans = $jabatans->paginate(15); 
        
        // Kirim data ke view, termasuk kata kunci pencarian
        return view('admin.jabatan.index', compact('jabatans', 'search'));
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
        // 1. Validasi Input: Memastikan ID Lembaga ada dan valid (exists)
        $validatedData = $request->validate([
            'lembaga_id' => 'required|integer|exists:lembaga,lembaga_id', 
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        // 2. Simpan ke database (Hanya SATU kali)
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