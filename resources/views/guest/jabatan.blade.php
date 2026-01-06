@extends('guest.layout')

@section('title', 'Jabatan')
@section('page-title', 'Jabatan')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-briefcase"></i> Jabatan
        </h2>
    </div>
</div>

<div class="row">
    @forelse($jabatans as $jabatan)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-briefcase me-2"></i>
                    {{ $jabatan->nama_jabatan }}
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Lembaga:</small>
                    <p class="mb-2">
                        <i class="fas fa-building me-1"></i>
                        {{ $jabatan->nama_lembaga ?? 'Tidak ada lembaga' }}
                    </p>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Level:</small>
                    <p class="mb-0">
                        @if($jabatan->level == 'Tinggi')
                            <span class="badge bg-danger">
                                <i class="fas fa-star me-1"></i>{{ $jabatan->level }}
                            </span>
                        @elseif($jabatan->level == 'Menengah')
                            <span class="badge bg-warning">
                                <i class="fas fa-star-half-alt me-1"></i>{{ $jabatan->level }}
                            </span>
                        @else
                            <span class="badge bg-info">
                                <i class="fas fa-circle me-1"></i>{{ $jabatan->level }}
                            </span>
                        @endif
                    </p>
                </div>

                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-primary mb-0">{{ $jabatan->id }}</h6>
                            <small class="text-muted">ID Jabatan</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-success mb-0">{{ $jabatan->lembaga_id }}</h6>
                        <small class="text-muted">ID Lembaga</small>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Dibuat: {{ isset($jabatan->created_at) ? \Carbon\Carbon::parse($jabatan->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-briefcase" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data jabatan</h5>
                <p class="text-muted">Belum ada jabatan yang terdaftar dalam sistem.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

<!-- Summary Card -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie"></i> Ringkasan Jabatan
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <h4 class="text-primary">{{ $jabatans->count() }}</h4>
                        <p class="text-muted mb-0">Total Jabatan</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-danger">{{ $jabatans->where('level', 'Tinggi')->count() }}</h4>
                        <p class="text-muted mb-0">Level Tinggi</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-warning">{{ $jabatans->where('level', 'Menengah')->count() }}</h4>
                        <p class="text-muted mb-0">Level Menengah</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-info">{{ $jabatans->where('level', 'Rendah')->count() }}</h4>
                        <p class="text-muted mb-0">Level Rendah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection