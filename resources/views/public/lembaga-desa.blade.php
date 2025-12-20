@extends('layouts.app')

@section('title', 'Lembaga Desa')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Lembaga Desa</h2>
    </div>
    
    <div class="row">
        @forelse($lembagaDesa as $lembaga)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #667eea;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-primary mb-0">{{ $lembaga->nama_lembaga }}</h5>
                        <i class="fas fa-building fa-2x text-primary"></i>
                    </div>
                    <p class="card-text text-muted">{{ $lembaga->alamat ?? '-' }}</p>
                    <div class="mt-3">
                        @if($lembaga->jabatans->count() > 0)
                        <span class="badge bg-info">{{ $lembaga->jabatans->count() }} Jabatan</span>
                        @endif
                        @if($lembaga->anggotaLembaga->count() > 0)
                        <span class="badge bg-success ms-2">{{ $lembaga->anggotaLembaga->count() }} Anggota</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Belum ada data Lembaga Desa</div>
        </div>
        @endforelse
    </div>
</div>
@endsection

