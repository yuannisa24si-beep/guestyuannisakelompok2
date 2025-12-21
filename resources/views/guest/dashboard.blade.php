@extends('guest.layout')

@section('title', 'SIDESA Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-chart-bar"></i> Dashboard Overview
        </h2>
    </div>
</div>

<!-- Data Sync Status -->
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-success border-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
            <div class="d-flex align-items-center">
                <i class="fas fa-sync-alt me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h6 class="mb-1">Data Tersinkronisasi</h6>
                    <small>Semua data yang ditampilkan di portal ini tersinkronisasi secara real-time dengan sistem admin. 
                    Ketika admin menambah, mengubah, atau menghapus data, perubahan akan langsung terlihat di sini.
                    @if(isset($lastUpdate) && $lastUpdate->last_update)
                        <br><strong>Terakhir diperbarui:</strong> {{ \Carbon\Carbon::parse($lastUpdate->last_update)->format('d M Y H:i') }}
                    @endif
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalWarga ?? 0 }}</h3>
                    <p class="mb-0">Total Warga</p>
                </div>
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalUsers ?? 0 }}</h3>
                    <p class="mb-0">Total User</p>
                </div>
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalLembaga ?? 0 }}</h3>
                    <p class="mb-0">Lembaga Desa</p>
                </div>
                <i class="fas fa-building"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalPerangkat ?? 0 }}</h3>
                    <p class="mb-0">Perangkat Desa</p>
                </div>
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
    </div>
</div>

<!-- Second Row Statistics -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalRT ?? 0 }}</h3>
                    <p class="mb-0">Total RT</p>
                </div>
                <i class="fas fa-map-marker-alt"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalRW ?? 0 }}</h3>
                    <p class="mb-0">Total RW</p>
                </div>
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalJabatan ?? 0 }}</h3>
                    <p class="mb-0">Total Jabatan</p>
                </div>
                <i class="fas fa-briefcase"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $totalAnggota ?? 0 }}</h3>
                    <p class="mb-0">Anggota Lembaga</p>
                </div>
                <i class="fas fa-users-cog"></i>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Card -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Sistem Informasi Desa Digital
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="text-muted mb-3">
                            Portal ini menyediakan akses untuk melihat informasi publik mengenai data desa, 
                            termasuk informasi lembaga, jabatan, warga, dan struktur organisasi desa.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2">Lihat data lembaga desa</li>
                            <li class="mb-2">Informasi jabatan dan struktur organisasi</li>
                            <li class="mb-2">Data warga dan perangkat desa</li>
                            <li class="mb-2">Informasi RW dan RT</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Access -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-rocket"></i> Akses Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('guest.warga') }}" class="btn btn-purple w-100">
                            <i class="fas fa-users mb-2 d-block"></i>
                            Data Warga
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('guest.lembaga-desa') }}" class="btn btn-purple w-100">
                            <i class="fas fa-building mb-2 d-block"></i>
                            Lembaga Desa
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('guest.perangkat-desa') }}" class="btn btn-purple w-100">
                            <i class="fas fa-user-tie mb-2 d-block"></i>
                            Perangkat Desa
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('guest.anggota-lembaga') }}" class="btn btn-purple w-100">
                            <i class="fas fa-users-cog mb-2 d-block"></i>
                            Anggota Lembaga
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection