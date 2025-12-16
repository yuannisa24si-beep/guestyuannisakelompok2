<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; // 💡 Diperlukan untuk hashing password
use App\Models\Warga;

class Authcontroller extends Controller
{
    // Tampilkan Form Login
    public function index()
    {
        return view('auth.login');
    }

    // Tampilkan Form Pendaftaran (NEW)
    public function registerForm()
    {
        return view('auth.register');
    }

    // Proses Pendaftaran dan Simpan ke DB (NEW)
    public function registerStore(Request $request)
    {
        // 1. Validasi Input Pendaftaran
        $request->validate([
            'nama'      => 'required|string|max:255',
            'email'     => 'required|email|unique:warga,email', // Email harus unik
            'password'  => 'required|string|min:6|confirmed', // 'confirmed' berarti harus cocok dengan password_confirmation
            'nik'       => 'required|string|max:16|unique:warga,nik',
            'alamat'    => 'nullable|string',
            'telepon'   => 'nullable|string|max:15',
        ]);

        // 2. Buat data Warga baru
        Warga::create([
            'nama'      => $request->nama,
            'email'     => $request->email,
            'password'  => Hash::make($request->password), // Password wajib di-hash!
            'nik'       => $request->nik,
            'alamat'    => $request->alamat,
            'telepon'   => $request->telepon,
            'role'      => 'warga', // Set role default untuk pendaftar baru
        ]);

        // 3. Redirect ke halaman login setelah pendaftaran berhasil
        return redirect()->route('auth.index')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // Proses Login (DIUBAH)
    public function login(Request $request)
    {
       // 1. Validasi input
       $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string', 
        ]);

        // 2. Coba otentikasi
        if (Auth::attempt($credentials)) {
            // Otentikasi berhasil
            $request->session()->regenerate();
            session(['last_login' => now()]);

            // Redirect ke halaman dashboard (warga.index)
            return redirect()->route('warga.index')->with('success', 'Login berhasil!');
        } else {
            // Otentikasi gagal
            return back()->withErrors(['email' => 'Email atau Password salah'])->withInput();
        }
    }

    // Proses Logout (DITAMBAH DI DALAM CLASS)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        return redirect()->route('auth.index');
    }
}