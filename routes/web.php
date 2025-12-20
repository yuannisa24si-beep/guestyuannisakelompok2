<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\AnggotaLembagaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataCardController;


Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan data dalam bentuk card
Route::get('/data-cards', [DataCardController::class, 'index'])->name('data.cards');
Route::get('anggota/', function () {
    return view('anggota');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route admin dengan middleware auth dan checkrole untuk Admin
Route::prefix('admin')->middleware(['auth', 'checkrole:Admin'])->group(function () {
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

// Route admin untuk CRUD Warga - hanya admin yang bisa akses
Route::prefix('admin')->middleware(['auth', 'checkrole:Admin'])->group(function () {
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

// Route public untuk semua menu (read-only)
Route::get('/warga', [WargaController::class, 'publicIndex'])->name('warga.public');
Route::get('/lembaga-desa', [LembagaDesaController::class, 'publicIndex'])->name('lembaga-desa.public');
Route::get('/perangkat-desa', [PerangkatDesaController::class, 'publicIndex'])->name('perangkat-desa.public');
Route::get('/rw', [RwController::class, 'publicIndex'])->name('rw.public');
Route::get('/rt', [RtController::class, 'publicIndex'])->name('rt.public');
Route::get('/anggota-lembaga', [AnggotaLembagaController::class, 'publicIndex'])->name('anggota-lembaga.public');
Route::get('/users', [UserController::class, 'publicIndex'])->name('users.public'); 

// Route duplikat dihapus - sudah di-handle di atas

Route::get('auth', [AuthController::class, 'index'])->name('auth');

Route::post('auth/login', [AuthController::class, 'login'] )->name('auth.login');

Route::post('auth/logout', [AuthController::class, 'logout'] )->name('auth.logout');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.index'); 
    Route::get('/login', 'login')->name('auth.login'); // Rute POST yang benar
    Route::post('/logout', 'logout')->name('auth.logout');
});

// Route admin untuk CRUD Warga - hanya admin yang bisa akses
Route::prefix('admin')->middleware(['auth', 'checkrole:Admin'])->group(function () {
    // Route CRUD untuk Warga
    Route::resource('warga', WargaController::class)
        ->names('warga.crud') // Menggunakan nama route yang konsisten
        ->except(['show']); // Tidak memerlukan halaman show
});

Route::get('/auth/login', [Authcontroller::class, 'index'])->name('auth.index');
// Rute untuk memproses login
Route::post('/auth/login', [Authcontroller::class, 'login'])->name('auth.login');

// Rute untuk menampilkan form pendaftaran (NEW)
Route::get('/auth/register', [Authcontroller::class, 'registerForm'])->name('auth.register.form');
// Rute untuk memproses pendaftaran (NEW)
Route::post('/auth/register', [Authcontroller::class, 'registerStore'])->name('auth.register.store');

// Rute untuk logout
Route::post('/auth/logout', [Authcontroller::class, 'logout'])->name('auth.logout');


//Route::group(['middleware'=>['checkislogin']],function(){

    //Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');

//});

//Route::group(['middleware'=>['checkrole']],function(){

    //Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');

//});