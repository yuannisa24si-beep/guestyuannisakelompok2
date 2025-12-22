<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\Jabatan;
use App\Models\Warga;
use App\Models\PerangkatDesa;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\AnggotaLembaga;

class GuestController extends Controller
{
    public function dashboard()
    {
        try {
            $totalLembaga = \DB::table('lembaga_desa')->count();
            $totalJabatan = \DB::table('jabatans')->count();
            $totalWarga = \DB::table('wargas')->count();
            $totalPerangkat = \DB::table('perangkat_desa')->count();
        } catch (\Exception $e) {
            $totalLembaga = 0;
            $totalJabatan = 0;
            $totalWarga = 0;
            $totalPerangkat = 0;
        }
        
        return view('guest.dashboard', compact('totalLembaga', 'totalJabatan', 'totalWarga', 'totalPerangkat'));
    }

    public function lembagaDesa()
    {
        try {
            $lembagas = \DB::table('lembaga_desa')->get();
        } catch (\Exception $e) {
            $lembagas = collect();
        }
        return view('guest.lembaga-desa', compact('lembagas'));
    }

    public function jabatan()
    {
        try {
            $jabatans = \DB::table('jabatans')
                ->leftJoin('lembaga_desa', 'jabatans.lembaga_id', '=', 'lembaga_desa.lembaga_id')
                ->select('jabatans.*', 'lembaga_desa.nama_lembaga')
                ->get();
        } catch (\Exception $e) {
            $jabatans = collect();
        }
        return view('guest.jabatan', compact('jabatans'));
    }

    public function warga()
    {
        try {
            $wargas = \DB::table('wargas')->get();
        } catch (\Exception $e) {
            $wargas = collect();
        }
        return view('guest.warga', compact('wargas'));
    }

    public function perangkatDesa()
    {
        try {
            $perangkats = \DB::table('perangkat_desa')
                ->leftJoin('wargas', 'perangkat_desa.warga_id', '=', 'wargas.warga_id')
                ->select('perangkat_desa.*', 'wargas.nama', 'wargas.jenis_kelamin')
                ->get();
        } catch (\Exception $e) {
            $perangkats = collect();
        }
        return view('guest.perangkat-desa', compact('perangkats'));
    }

    public function rw()
    {
        try {
            $rws = \DB::table('rw')
                ->leftJoin('wargas', 'rw.ketua_rw_warga_id', '=', 'wargas.warga_id')
                ->select('rw.*', 'wargas.nama as ketua_nama', 'wargas.jenis_kelamin', 'wargas.telp')
                ->get();
        } catch (\Exception $e) {
            $rws = collect();
        }
        return view('guest.rw', compact('rws'));
    }

    public function rt()
    {
        try {
            $rts = \DB::table('rt')
                ->leftJoin('rw', 'rt.rw_id', '=', 'rw.rw_id')
                ->leftJoin('wargas as ketua_rt', 'rt.ketua_rt_warga_id', '=', 'ketua_rt.warga_id')
                ->leftJoin('wargas as ketua_rw', 'rw.ketua_rw_warga_id', '=', 'ketua_rw.warga_id')
                ->select('rt.*', 'rw.nomor_rw', 'ketua_rt.nama as ketua_rt_nama', 'ketua_rt.jenis_kelamin as ketua_rt_gender', 'ketua_rt.telp as ketua_rt_telp', 'ketua_rw.nama as ketua_rw_nama')
                ->get();
        } catch (\Exception $e) {
            $rts = collect();
        }
        return view('guest.rt', compact('rts'));
    }

    public function anggotaLembaga()
    {
        try {
            $anggotas = \DB::table('anggota_lembaga')
                ->leftJoin('lembaga_desa', 'anggota_lembaga.lembaga_id', '=', 'lembaga_desa.lembaga_id')
                ->leftJoin('wargas', 'anggota_lembaga.warga_id', '=', 'wargas.warga_id')
                ->leftJoin('jabatans', 'anggota_lembaga.jabatan_id', '=', 'jabatans.id')
                ->select('anggota_lembaga.*', 'lembaga_desa.nama_lembaga', 'wargas.nama as warga_nama', 'wargas.jenis_kelamin', 'wargas.pekerjaan', 'jabatans.nama_jabatan', 'jabatans.level')
                ->get();
        } catch (\Exception $e) {
            $anggotas = collect();
        }
        return view('guest.anggota-lembaga', compact('anggotas'));
    }

    public function profile()
    {
        return view('guest.profile');
    }
}