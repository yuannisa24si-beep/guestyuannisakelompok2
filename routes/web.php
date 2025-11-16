<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanLembagaController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('anggota/', function () {
    return view('anggota');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('jabatanlembaga', JabatanLembagaController::class);

Route::get('/', function () {
    // Tampilan ini akan me-load resources/views/home/index.blade.php
    return view('index');
});

Route::get('/menu', function () {
    // Tampilan ini akan me-load resources/views/menu/menu.blade.php
    return view('menu');
});

// Rute BARU untuk menampilkan Halaman About
Route::get('/about', function () {
    // Tampilan ini akan me-load resources/views/about/about.blade.php
    return view('about');
});

// Rute BARU untuk menampilkan Halaman About
Route::get('/book', function () {
    // Tampilan ini akan me-load resources/views/about/about.blade.php
    return view('book');
});
// Rute untuk menampilkan Daftar Jabatan
Route::get('/jabatan', function () {
    // Tampilan ini akan me-load resources/views/jabatan/jabatan.blade.php
    return view('jabatan');
});

// Rute untuk menampilkan Halaman Tentang Lembaga
Route::get('/tentang', function () {
    // Tampilan ini akan me-load resources/views/tentang/tentang.blade.php
    return view('tentang');
});

// Rute untuk menampilkan Halaman Kontak/Permintaan Data
Route::get('/kontak', function () {
    // Tampilan ini akan me-load resources/views/kontak/kontak.blade.php
    return view('kontak');
});
