@extends('guest.layout')

@section('title', 'Lembaga Desa')
@section('page-title', 'Lembaga Desa')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-building"></i> Lembaga Desa
        </h2>
    </div>
</div>

<div class="row">
    @forelse($lembagas as $lembaga)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-building me-2"></i>
                    {{ $lembaga->nama_lembaga }}
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Alamat:</small>
                    <p class="mb-2">{{ $lembaga->alamat ?? 'Alamat tidak tersedia' }}</p>
                </div>

                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-primary mb-0">{{ $lembaga->lembaga_id }}</h6>
                            <small class="text-muted">ID Lembaga</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-success mb-0">
                            {{ isset($lembaga->created_at) ? \Carbon\Carbon::parse($lembaga->created_at)->format('Y') : 'N/A' }}
                        </h6>
                        <small class="text-muted">Tahun Dibuat</small>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Dibuat: {{ isset($lembaga->created_at) ? \Carbon\Carbon::parse($lembaga->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-building" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data lembaga</h5>
                <p class="text-muted">Belum ada lembaga yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Ringkasan Data
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-primary">{{ $lembagas->count() }}</h4>
                        <p class="text-muted mb-0">Total Lembaga</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-success">{{ $lembagas->whereNotNull('alamat')->count() }}</h4>
                        <p class="text-muted mb-0">Memiliki Alamat</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-info">{{ $lembagas->where('created_at', '>=', now()->subYear())->count() }}</h4>
                        <p class="text-muted mb-0">Dibuat Tahun Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection