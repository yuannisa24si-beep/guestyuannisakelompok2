@extends('layouts.app')

@section('title', 'Jabatan')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Jabatan</h2>
    </div>
    
    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('jabatan.public') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari (Nama Jabatan / Lembaga)" value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @forelse($jabatans as $jabatan)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #f59e0b;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-warning mb-0">{{ $jabatan->nama_jabatan }}</h5>
                        <i class="fas fa-user-tie fa-2x text-warning"></i>
                    </div>
                    <p class="card-text">
                        <strong>Lembaga:</strong> {{ $jabatan->lembaga->nama_lembaga ?? '-' }}<br>
                        <strong>Level:</strong> 
                        <span class="badge 
                            @if($jabatan->level == 1) bg-success
                            @elseif($jabatan->level == 2) bg-primary
                            @elseif($jabatan->level == 3) bg-info
                            @else bg-secondary
                            @endif">
                            @if($jabatan->level == 1) Pimpinan
                            @elseif($jabatan->level == 2) Manager
                            @elseif($jabatan->level == 3) Staf
                            @else Level {{ $jabatan->level }}
                            @endif
                        </span>
                    </p>
                    @if($jabatan->deskripsi)
                    <p class="card-text text-muted small">{{ Str::limit($jabatan->deskripsi, 100) }}</p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Belum ada data Jabatan</div>
        </div>
        @endforelse
    </div>
    
    @if($jabatans->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $jabatans->links() }}
    </div>
    @endif
</div>
@endsection

