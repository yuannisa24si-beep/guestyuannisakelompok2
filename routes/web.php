<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Redirect root to guest dashboard
Route::get('/', function () {
    // Debug: pastikan redirect berfungsi
    return redirect()->route('guest.dashboard');
});

// Test route untuk debugging
Route::get('/test-redirect', function () {
    return response()->json([
        'message' => 'Redirect test',
        'guest_dashboard_url' => route('guest.dashboard'),
        'current_url' => request()->url()
    ]);
});

// Test database connection simple
Route::get('/test-db-simple', function () {
    try {
        $connection = DB::connection();
        $pdo = $connection->getPdo();
        
        // Test query sederhana
        $result = DB::select('SHOW TABLES');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Database connected successfully',
            'database' => config('database.connections.mysql.database'),
            'tables' => $result
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'config' => [
                'host' => config('database.connections.mysql.host'),
                'port' => config('database.connections.mysql.port'),
                'database' => config('database.connections.mysql.database'),
                'username' => config('database.connections.mysql.username')
            ]
        ]);
    }
});

// Guest Routes with database data
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/dashboard', function() {
        try {
            $totalLembaga = DB::table('lembaga')->count();
            $totalJabatan = DB::table('jabatan_lembaga')->count();
            $totalWarga = DB::table('warga')->count();
            $totalPerangkat = DB::table('perangkat_desa')->count();
            $totalUsers = DB::table('warga')->where('role', 'admin')->count(); // Count admin users
            $totalRW = DB::table('rw')->count();
            $totalRT = DB::table('rt')->count();
            $totalAnggota = DB::table('anggota_lembaga')->count();
            
            // Get last update timestamp
            $lastUpdate = DB::table('lembaga')
                ->selectRaw('MAX(updated_at) as last_update')
                ->unionAll(DB::table('jabatan_lembaga')->selectRaw('MAX(updated_at) as last_update'))
                ->unionAll(DB::table('warga')->selectRaw('MAX(updated_at) as last_update'))
                ->unionAll(DB::table('perangkat_desa')->selectRaw('MAX(updated_at) as last_update'))
                ->orderBy('last_update', 'desc')
                ->first();
                
        } catch (Exception $e) {
            // Fallback jika database error
            $totalLembaga = 0;
            $totalJabatan = 0;
            $totalWarga = 0;
            $totalPerangkat = 0;
            $totalUsers = 0;
            $totalRW = 0;
            $totalRT = 0;
            $totalAnggota = 0;
            $lastUpdate = null;
        }
        
        return view('guest.dashboard', [
            'totalLembaga' => $totalLembaga,
            'totalJabatan' => $totalJabatan,
            'totalWarga' => $totalWarga,
            'totalPerangkat' => $totalPerangkat,
            'totalUsers' => $totalUsers,
            'totalRW' => $totalRW,
            'totalRT' => $totalRT,
            'totalAnggota' => $totalAnggota,
            'lastUpdate' => $lastUpdate
        ]);
    })->name('dashboard');
    
    Route::get('/lembaga-desa', function() {
        try {
            $lembagas = DB::table('lembaga')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $lembagas = collect([]);
        }
        return view('guest.lembaga-desa', compact('lembagas'));
    })->name('lembaga-desa');
    
    Route::get('/jabatan', function() {
        try {
            $jabatans = DB::table('jabatan_lembaga')
                ->leftJoin('lembaga', 'jabatan_lembaga.lembaga_id', '=', 'lembaga.lembaga_id')
                ->select('jabatan_lembaga.*', 'lembaga.nama_lembaga')
                ->orderBy('jabatan_lembaga.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $jabatans = collect([]);
        }
        return view('guest.jabatan', compact('jabatans'));
    })->name('jabatan');
    
    Route::get('/warga', function() {
        try {
            $wargas = DB::table('warga')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $wargas = collect([]);
        }
        return view('guest.warga', compact('wargas'));
    })->name('warga');
    
    Route::get('/perangkat-desa', function() {
        try {
            $perangkats = DB::table('perangkat_desa')
                ->leftJoin('warga', 'perangkat_desa.warga_id', '=', 'warga.warga_id')
                ->select('perangkat_desa.*', 'warga.nama')
                ->orderBy('perangkat_desa.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $perangkats = collect([]);
        }
        return view('guest.perangkat-desa', compact('perangkats'));
    })->name('perangkat-desa');
    
    Route::get('/rw', function() {
        try {
            $rws = DB::table('rw')
                ->leftJoin('warga', 'rw.ketua_rw_warga_id', '=', 'warga.warga_id')
                ->select('rw.*', 'warga.nama as ketua_nama', 'warga.telepon as telp')
                ->orderBy('rw.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $rws = collect([]);
        }
        return view('guest.rw', compact('rws'));
    })->name('rw');
    
    Route::get('/rt', function() {
        try {
            $rts = DB::table('rt')
                ->leftJoin('rw', 'rt.rw_id', '=', 'rw.rw_id')
                ->leftJoin('warga as ketua_rt', 'rt.ketua_rt_warga_id', '=', 'ketua_rt.warga_id')
                ->leftJoin('warga as ketua_rw', 'rw.ketua_rw_warga_id', '=', 'ketua_rw.warga_id')
                ->select(
                    'rt.*',
                    'rw.nomor_rw',
                    'ketua_rt.nama as ketua_rt_nama',
                    'ketua_rt.telepon as ketua_rt_telp',
                    'ketua_rw.nama as ketua_rw_nama'
                )
                ->orderBy('rt.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $rts = collect([]);
        }
        return view('guest.rt', compact('rts'));
    })->name('rt');
    
    Route::get('/anggota-lembaga', function() {
        try {
            $anggotas = DB::table('anggota_lembaga')
                ->leftJoin('lembaga', 'anggota_lembaga.lembaga_id', '=', 'lembaga.lembaga_id')
                ->leftJoin('warga', 'anggota_lembaga.warga_id', '=', 'warga.warga_id')
                ->leftJoin('jabatan_lembaga', 'anggota_lembaga.jabatan_id', '=', 'jabatan_lembaga.jabatan_id')
                ->select(
                    'anggota_lembaga.*',
                    'lembaga.nama_lembaga',
                    'warga.nama as warga_nama',
                    'jabatan_lembaga.nama_jabatan',
                    'jabatan_lembaga.level'
                )
                ->orderBy('anggota_lembaga.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $anggotas = collect([]);
        }
        return view('guest.anggota-lembaga', compact('anggotas'));
    })->name('anggota-lembaga');
    
    Route::get('/profile', function() {
        return view('guest.profile');
    })->name('profile');
    
    Route::get('/pengaturan', function() {
        return view('guest.pengaturan');
    })->name('pengaturan');
    
    Route::get('/users', function() {
        try {
            $users = DB::table('warga')
                ->select('warga_id', 'nama', 'email', 'role', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            $users = collect([]);
        }
        return view('guest.users', compact('users'));
    })->name('users');
});

// Route test database connection
Route::get('/test-database', function() {
    try {
        $results = [];
        
        // Test each table
        $tables = ['jabatan_lembaga', 'lembaga', 'warga', 'perangkat_desa', 'rw', 'rt', 'anggota_lembaga'];
        
        foreach ($tables as $table) {
            try {
                $count = DB::table($table)->count();
                $results[$table] = [
                    'status' => 'success',
                    'count' => $count,
                    'sample' => DB::table($table)->limit(1)->first()
                ];
            } catch (Exception $e) {
                $results[$table] = [
                    'status' => 'error',
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Database connection test completed',
            'database' => config('database.connections.mysql.database'),
            'results' => $results
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Database connection failed: ' . $e->getMessage(),
            'config' => [
                'host' => config('database.connections.mysql.host'),
                'port' => config('database.connections.mysql.port'),
                'database' => config('database.connections.mysql.database'),
                'username' => config('database.connections.mysql.username')
            ]
        ]);
    }
});