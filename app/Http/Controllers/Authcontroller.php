<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 💡 PASTIKAN BARIS INI ADA
use Illuminate\Support\Facades\Auth; 
// 💡 PASTIKAN BARIS INI ADA
use App\Models\Warga;

class Authcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

   public function login(Request $request)
    {
       $request->validate([
            'nama' => 'required|string|max:255',
            // Ganti 'nik' menjadi validasi string biasa
            'nik'    => 'required|string|max:16', 
        ]);

        $warga = warga::where('nik', $request->nik)
              ->where('nama', $request->nama) 
              ->first();

        if ($warga) {
            Auth::login($warga);
            session(['last_login' => now()]);

            return redirect()->route('warga.index')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['nik' => 'Nama atau nik salah'])->withInput();
        }
}
}
function logout(Request $request)
{
		Auth::logout();
    $request->session()->invalidate();     // Hapus semua session
    $request->session()->regenerateToken(); // Cegah CSRF
    
		// Redirect ke halaman login
}