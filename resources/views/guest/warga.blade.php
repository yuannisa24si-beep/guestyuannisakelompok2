@extends('guest.layout')

@section('title', 'Data Warga')
@section('page-title', 'Data Warga')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-users"></i> Data Warga
        </h2>
    </div>
</div>

<div class="row">
    @forelse($wargas as $warga)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    {{ $warga->nama }}
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <small class="text-muted">NIK:</small>
                    <p class="mb-1 font-monospace">{{ $warga->nik }}</p>
                </div>
                
                <div class="mb-2">
                    <small class="text-muted">Role:</small>
                    <p class="mb-1">
                        <i class="fas fa-user-tag me-1"></i>{{ ucfirst($warga->role) }}
                    </p>
                </div>

                <div class="mb-2">
                    <small class="text-muted">Alamat:</small>
                    <p class="mb-1">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $warga->alamat ?? 'Alamat tidak tersedia' }}
                    </p>
                </div>

                <div class="mb-2">
                    <small class="text-muted">Telepon:</small>
                    <p class="mb-1">
                        <i class="fas fa-phone me-1"></i>{{ $warga->telepon ?? 'Tidak ada telepon' }}
                    </p>
                </div>

                @if($warga->email)
                <div class="mb-2">
                    <small class="text-muted">Email:</small>
                    <p class="mb-1">
                        <i class="fas fa-envelope me-1"></i>{{ $warga->email }}
                    </p>
                </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    ID: {{ $warga->warga_id }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-users" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data warga</h5>
                <p class="text-muted">Belum ada warga yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Statistik Warga
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <h4 class="text-primary">{{ $wargas->count() }}</h4>
                        <p class="text-muted mb-0">Total Warga</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-info">{{ $wargas->where('role', 'warga')->count() }}</h4>
                        <p class="text-muted mb-0">Role Warga</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-warning">{{ $wargas->where('role', 'admin')->count() }}</h4>
                        <p class="text-muted mb-0">Role Admin</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-success">{{ $wargas->whereNotNull('email')->count() }}</h4>
                        <p class="text-muted mb-0">Memiliki Email</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection