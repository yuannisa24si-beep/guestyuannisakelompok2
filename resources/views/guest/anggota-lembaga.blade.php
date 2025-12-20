@extends('guest.layout')

@section('title', 'Anggota Lembaga')
@section('page-title', 'Anggota Lembaga')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-users-cog"></i> Anggota Lembaga
        </h2>
    </div>
</div>

<div class="row">
    @forelse($anggotas as $anggota)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    {{ $anggota->warga_nama ?? 'Nama tidak tersedia' }}
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Lembaga:</small>
                    <p class="mb-1 fw-bold text-primary">
                        <i class="fas fa-building me-1"></i>
                        {{ $anggota->nama_lembaga ?? 'Lembaga tidak tersedia' }}
                    </p>
                </div>

                @if($anggota->nama_jabatan)
                <div class="mb-3">
                    <small class="text-muted">Jabatan:</small>
                    <p class="mb-1">
                        <i class="fas fa-briefcase me-1"></i>
                        {{ $anggota->nama_jabatan }}
                        @if($anggota->level)
                            @if($anggota->level == 'Tinggi')
                                <span class="badge bg-danger ms-1">{{ $anggota->level }}</span>
                            @elseif($anggota->level == 'Menengah')
                                <span class="badge bg-warning ms-1">{{ $anggota->level }}</span>
                            @else
                                <span class="badge bg-info ms-1">{{ $anggota->level }}</span>
                            @endif
                        @endif
                    </p>
                </div>
                @endif
                
                <div class="mb-2">
                    <small class="text-muted">Tanggal Mulai:</small>
                    <p class="mb-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ isset($anggota->tgl_mulai) ? \Carbon\Carbon::parse($anggota->tgl_mulai)->format('d M Y') : 'N/A' }}
                    </p>
                </div>

                @if($anggota->tgl_selesai)
                <div class="mb-2">
                    <small class="text-muted">Tanggal Selesai:</small>
                    <p class="mb-1">
                        <i class="fas fa-calendar-check me-1"></i>
                        {{ \Carbon\Carbon::parse($anggota->tgl_selesai)->format('d M Y') }}
                    </p>
                </div>
                @else
                <div class="mb-2">
                    <span class="badge bg-success">
                        <i class="fas fa-check me-1"></i>Aktif
                    </span>
                </div>
                @endif

                <div class="row text-center mt-3">
                    <div class="col-4">
                        <h6 class="text-primary mb-0">{{ $anggota->anggota_id }}</h6>
                        <small class="text-muted">ID</small>
                    </div>
                    <div class="col-4">
                        <h6 class="text-success mb-0">{{ $anggota->lembaga_id }}</h6>
                        <small class="text-muted">Lembaga</small>
                    </div>
                    <div class="col-4">
                        <h6 class="text-info mb-0">{{ $anggota->warga_id }}</h6>
                        <small class="text-muted">Warga</small>
                    </div>
                </div>

                @if($anggota->warga_nama)
                <div class="mt-3 p-2 bg-light rounded">
                    <small class="text-muted">Info Warga:</small>
                    <div class="d-flex justify-content-between">
                        <span>{{ $anggota->warga_nama }}</span>
                        <span>ID: {{ $anggota->warga_id }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Bergabung: {{ isset($anggota->created_at) ? \Carbon\Carbon::parse($anggota->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-users-cog" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data anggota lembaga</h5>
                <p class="text-muted">Belum ada anggota lembaga yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Statistik Anggota Lembaga
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-primary">{{ $anggotas->count() }}</h4>
                        <p class="text-muted mb-0">Total Anggota</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-success">{{ $anggotas->whereNull('tgl_selesai')->count() }}</h4>
                        <p class="text-muted mb-0">Anggota Aktif</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-info">{{ $anggotas->whereNotNull('jabatan_id')->count() }}</h4>
                        <p class="text-muted mb-0">Memiliki Jabatan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection