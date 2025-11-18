<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\wargaController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('anggota/', function () {
    return view('anggota');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('admin')->group(function () {
    // BARIS KRITIS 2: HARUS MENGGUNAKAN JABATANCONTROLLER
    Route::resource('jabatan', JabatanController::class)->names([
        'index' => 'jabatan.crud.index',
        'create' => 'jabatan.crud.create',
        'store' => 'jabatan.crud.store',
        'edit' => 'jabatan.crud.edit',
        'update' => 'jabatan.crud.update',
        'destroy' => 'jabatan.crud.destroy',
    ]);
});

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

Route::get('/jabatan', [JabatanController::class, 'publicIndex'])->name('jabatan.public');

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

Route::prefix('admin')->group(function () {
    // CRUD Jabatan Lembaga (Sudah ada)
    Route::resource('jabatan', JabatanController::class)->names([
        'index' => 'jabatan.crud.index',
        'create' => 'jabatan.crud.create',
        'store' => 'jabatan.crud.store',
        'edit' => 'jabatan.crud.edit',
        'update' => 'jabatan.crud.update',
        'destroy' => 'jabatan.crud.destroy',
    ]);

    // Tambahkan CRUD Data Warga
    Route::resource('warga', WargaController::class)->names([
        'index' => 'warga.index',
        'create' => 'warga.create',
        'store' => 'warga.store',
        'edit' => 'warga.edit',
        'update' => 'warga.update',
        'destroy' => 'warga.destroy',
    ]);
});

Route::get('/warga', [WargaController::class, 'index'])->name('warga.public.index'); 

// 2. Rute Admin (CRUD) Warga
Route::prefix('admin')->group(function () {
    // ... rute jabatan
    
    // CRUD WARGA
    Route::resource('warga', WargaController::class)->names([ // <-- Gunakan nama resource 'warga'
        'index' => 'warga.index', 
        'create' => 'warga.create',
        'store' => 'warga.store',
        'edit' => 'warga.edit',
        'update' => 'warga.update',
        'destroy' => 'warga.destroy',
    ]);
});