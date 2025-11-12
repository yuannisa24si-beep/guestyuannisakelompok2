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
