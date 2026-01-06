<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Redirect root to guest dashboard
Route::get('/', function () {
    return redirect()->route('guest.dashboard');
});

// Debug route untuk warga data
Route::get('/debug/warga', function () {
    try {
        $count = DB::table('wargas')->count();
        $sample = DB::table('wargas')->limit(5)->get();
        $columns = $sample->isEmpty() ? [] : array_keys((array)$sample[0]);
        $stats = [
            'total' => $count,
            'laki_laki' => DB::table('wargas')->where('jenis_kelamin', 'L')->count(),
            'perempuan' => DB::table('wargas')->where('jenis_kelamin', 'P')->count(),
            'dengan_email' => DB::table('wargas')->whereNotNull('email')->count(),
            'dengan_foto' => DB::table('wargas')->whereNotNull('foto_profil_path')->count(),
        ];
        
        return response()->json([
            'status' => 'success',
            'message' => 'Warga data retrieved successfully',
            'total_records' => $count,
            'statistics' => $stats,
            'columns' => $columns,
            'sample_data' => $sample,
            'table_name' => 'wargas',
            'primary_key' => 'warga_id'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'table_name' => 'wargas'
        ], 500);
    }
});

// Debug route - data source summary
Route::get('/debug/sources', function () {
    return response()->json([
        'database_config' => [
            'driver' => config('database.default'),
            'host' => config('database.connections.mysql.host'),
            'port' => config('database.connections.mysql.port'),
            'database' => config('database.connections.mysql.database'),
            'username' => config('database.connections.mysql.username')
        ],
        'data_sources' => [
            'wargas' => [
                'route' => 'GET /guest/warga',
                'query' => 'DB::table("wargas")->orderBy("created_at", "desc")->get()',
                'source' => 'Clever Cloud MySQL - wargas table',
                'structure' => ['warga_id', 'no_ktp', 'nama', 'jenis_kelamin', 'agama', 'pekerjaan', 'telp', 'email', 'foto_profil_path', 'created_at', 'updated_at']
            ],
            'lembaga_desa' => [
                'route' => 'GET /guest/lembaga-desa',
                'query' => 'DB::table("lembaga_desa")->orderBy("created_at", "desc")->get()',
                'source' => 'Clever Cloud MySQL - lembaga_desa table'
            ],
            'jabatans' => [
                'route' => 'GET /guest/jabatan',
                'query' => 'DB::table("jabatans")->leftJoin("lembaga_desa")->get()',
                'source' => 'Clever Cloud MySQL - jabatans table'
            ],
            'perangkat_desa' => [
                'route' => 'GET /guest/perangkat-desa',
                'query' => 'DB::table("perangkat_desa")->leftJoin("wargas")->get()',
                'source' => 'Clever Cloud MySQL - perangkat_desa table'
            ],
            'rw' => [
                'route' => 'GET /guest/rw',
                'query' => 'DB::table("rw")->leftJoin("wargas")->get()',
                'source' => 'Clever Cloud MySQL - rw table'
            ],
            'rt' => [
                'route' => 'GET /guest/rt',
                'query' => 'DB::table("rt")->leftJoin("rw", "wargas")->get()',
                'source' => 'Clever Cloud MySQL - rt table'
            ],
            'anggota_lembaga' => [
                'route' => 'GET /guest/anggota-lembaga',
                'query' => 'DB::table("anggota_lembaga")->leftJoin(...)->get()',
                'source' => 'Clever Cloud MySQL - anggota_lembaga table'
            ],
            'users' => [
                'route' => 'GET /guest/users',
                'query' => 'DB::table("users")->orderBy("created_at", "desc")->get()',
                'source' => 'Clever Cloud MySQL - users table'
            ]
        ],
        'catatan' => [
            'data_asal' => 'Clever Cloud MySQL (bmahzyu0nyracep8hwdz)',
            'd.sql_role' => 'Hanya referensi struktur tabel dan naming convention, bukan sumber data'
        ],
        'debug_routes' => [
            '/debug/warga' => 'Tampilkan detail data warga dari Clever Cloud',
            '/debug/sources' => 'Tampilkan sumber data semua tabel'
        ]
    ]);
});

// Guest Routes with database data
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/dashboard', function() {
        $errorMessage = null;
        $totalLembaga = 0;
        $totalJabatan = 0;
        $totalWarga = 0;
        $totalPerangkat = 0;
        $totalUsers = 0;
        $totalRW = 0;
        $totalRT = 0;
        $totalAnggota = 0;
        $lastUpdate = null;
        
        // Check if tables exist and use appropriate table names
        try {
            // Try different table name combinations
            $tableNames = DB::select('SHOW TABLES');
            $existingTables = array_map(function($table) {
                return array_values((array)$table)[0];
            }, $tableNames);
            
            // For warga - check if it exists
            if (in_array('wargas', $existingTables)) {
                $totalWarga = DB::table('wargas')->count();
            }
            
            // For lembaga
            if (in_array('lembaga_desa', $existingTables)) {
                $totalLembaga = DB::table('lembaga_desa')->count();
            }
            
            // For jabatan
            if (in_array('jabatans', $existingTables)) {
                $totalJabatan = DB::table('jabatans')->count();
            }
            
            // For perangkat_desa
            if (in_array('perangkat_desa', $existingTables)) {
                $totalPerangkat = DB::table('perangkat_desa')->count();
            }
            
            // For rw
            if (in_array('rw', $existingTables)) {
                $totalRW = DB::table('rw')->count();
            }
            
            // For rt
            if (in_array('rt', $existingTables)) {
                $totalRT = DB::table('rt')->count();
            }
            
            // For anggota_lembaga
            if (in_array('anggota_lembaga', $existingTables)) {
                $totalAnggota = DB::table('anggota_lembaga')->count();
            }
            
            // For users
            if (in_array('users', $existingTables)) {
                $totalUsers = DB::table('users')->count();
            } else {
                // Fallback to warga with role = admin
                if (in_array('warga', $existingTables)) {
                    $totalUsers = DB::table('warga')->where('role', 'admin')->count();
                } elseif (in_array('wargas', $existingTables)) {
                    $totalUsers = DB::table('wargas')->where('role', 'admin')->count();
                }
            }
            
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
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
            'lastUpdate' => $lastUpdate,
            'errorMessage' => $errorMessage
        ]);
    })->name('dashboard');
    
    Route::get('/lembaga-desa', function() {
        try {
            $lembagas = DB::table('lembaga_desa')
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
            $jabatans = DB::table('jabatans')
                ->leftJoin('lembaga_desa', 'jabatans.lembaga_id', '=', 'lembaga_desa.lembaga_id')
                ->select('jabatans.*', 'lembaga_desa.nama_lembaga')
                ->orderBy('jabatans.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            // Fallback jika database error
            $jabatans = collect([]);
        }
        return view('guest.jabatan', compact('jabatans'));
    })->name('jabatan');
    
    Route::get('/warga', function() {
        try {
            $wargas = DB::table('wargas')
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
                ->leftJoin('wargas', 'perangkat_desa.warga_id', '=', 'wargas.warga_id')
                ->select('perangkat_desa.*', 'wargas.nama')
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
                ->leftJoin('wargas', 'rw.ketua_rw_warga_id', '=', 'wargas.warga_id')
                ->select('rw.*', 'wargas.nama as ketua_nama', 'wargas.telp as telp')
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
                ->leftJoin('wargas as ketua_rt', 'rt.ketua_rt_warga_id', '=', 'ketua_rt.warga_id')
                ->leftJoin('wargas as ketua_rw', 'rw.ketua_rw_warga_id', '=', 'ketua_rw.warga_id')
                ->select(
                    'rt.*',
                    'rw.nomor_rw',
                    'ketua_rt.nama as ketua_rt_nama',
                    'ketua_rt.telp as ketua_rt_telp',
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
                ->leftJoin('lembaga_desa', 'anggota_lembaga.lembaga_id', '=', 'lembaga_desa.lembaga_id')
                ->leftJoin('wargas', 'anggota_lembaga.warga_id', '=', 'wargas.warga_id')
                ->leftJoin('jabatans', 'anggota_lembaga.jabatan_id', '=', 'jabatans.id')
                ->select(
                    'anggota_lembaga.*',
                    'lembaga_desa.nama_lembaga',
                    'wargas.nama as warga_nama',
                    'jabatans.nama_jabatan',
                    'jabatans.level'
                )
                ->orderBy('anggota_lembaga.created_at', 'desc')
                ->get();
        } catch (Exception $e) {
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
            $users = DB::table('users')
                ->select('id', 'name', 'email', 'role', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            $users = collect([]);
        }
        return view('guest.users', compact('users'));
    })->name('users');
});
