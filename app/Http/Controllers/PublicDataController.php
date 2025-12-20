<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\LembagaDesa;
use App\Models\Jabatan;
use App\Models\PerangkatDesa;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\AnggotaLembaga;
use App\Models\User;
use Illuminate\Http\Request;

class PublicDataController extends Controller
{
    /**
     * Menampilkan data warga dalam format card
     */
    public function warga(Request $request)
    {
        $query = Warga::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('no_ktp', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $warga = $query->paginate(12);
        return view('public.warga', compact('warga'));
    }

    /**
     * Menampilkan data lembaga desa dalam format card
     */
    public function lembagaDesa(Request $request)
    {
        $query = LembagaDesa::with('jabatans', 'anggotaLembaga');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lembaga', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        $lembagaDesa = $query->paginate(12);
        return view('public.lembaga-desa', compact('lembagaDesa'));
    }

    /**
     * Menampilkan data jabatan dalam format card
     */
    public function jabatan(Request $request)
    {
        $query = Jabatan::with('lembaga');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_jabatan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('lembaga', function($q) use ($request) {
                      $q->where('nama_lembaga', 'like', '%' . $request->search . '%');
                  });
            });
        }
        
        if ($request->has('lembaga_id') && $request->lembaga_id) {
            $query->where('lembaga_id', $request->lembaga_id);
        }
        
        $jabatan = $query->paginate(12);
        $lembagaList = LembagaDesa::all();
        
        return view('public.jabatan', compact('jabatan', 'lembagaList'));
    }

    /**
     * Menampilkan data perangkat desa dalam format card
     */
    public function perangkatDesa(Request $request)
    {
        $query = PerangkatDesa::with('warga');
        
        if ($request->has('search') && $request->search) {
            $query->whereHas('warga', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })->orWhere('jabatan', 'like', '%' . $request->search . '%');
        }
        
        $perangkatDesa = $query->paginate(12);
        return view('public.perangkat-desa', compact('perangkatDesa'));
    }

    /**
     * Menampilkan data RW dalam format card
     */
    public function rw(Request $request)
    {
        $query = Rw::with('ketuaRw', 'rts');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nomor_rw', 'like', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('ketuaRw', function($q) use ($request) {
                      $q->where('nama', 'like', '%' . $request->search . '%');
                  });
            });
        }
        
        $rw = $query->paginate(12);
        return view('public.rw', compact('rw'));
    }

    /**
     * Menampilkan data RT dalam format card
     */
    public function rt(Request $request)
    {
        $query = Rt::with('rw', 'ketuaRt');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nomor_rt', 'like', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('ketuaRt', function($q) use ($request) {
                      $q->where('nama', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('rw', function($q) use ($request) {
                      $q->where('nomor_rw', 'like', '%' . $request->search . '%');
                  });
            });
        }
        
        if ($request->has('rw_id') && $request->rw_id) {
            $query->where('rw_id', $request->rw_id);
        }
        
        $rt = $query->paginate(12);
        $rwList = Rw::all();
        
        return view('public.rt', compact('rt', 'rwList'));
    }

    /**
     * Menampilkan data anggota lembaga dalam format card
     */
    public function anggotaLembaga(Request $request)
    {
        $query = AnggotaLembaga::with('lembaga', 'warga', 'jabatan');
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->whereHas('warga', function($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('lembaga', function($q) use ($request) {
                    $q->where('nama_lembaga', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('jabatan', function($q) use ($request) {
                    $q->where('nama_jabatan', 'like', '%' . $request->search . '%');
                });
            });
        }
        
        if ($request->has('lembaga_id') && $request->lembaga_id) {
            $query->where('lembaga_id', $request->lembaga_id);
        }
        
        $anggotaLembaga = $query->paginate(12);
        $lembagaList = LembagaDesa::all();
        
        return view('public.anggota-lembaga', compact('anggotaLembaga', 'lembagaList'));
    }

    /**
     * Menampilkan data users dalam format card (hanya untuk admin)
     */
    public function users(Request $request)
    {
        $query = User::query();
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }
        
        $users = $query->paginate(12);
        return view('public.users', compact('users'));
    }
}
