@extends('guest.layout')

@section('title', 'Perangkat Desa')
@section('page-title', 'Perangkat Desa')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-user-tie"></i> Perangkat Desa
        </h2>
    </div>
</div>

<div class="row">
    @forelse($perangkats as $perangkat)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-user-tie me-2"></i>
                    {{ $perangkat->nama ?? 'Nama tidak tersedia' }}
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <small class="text-muted">Jabatan:</small>
                    <p class="mb-1 fw-bold text-primary">{{ $perangkat->jabatan }}</p>
                </div>
                
                @if($perangkat->nip)
                <div class="mb-2">
                    <small class="text-muted">NIP:</small>
                    <p class="mb-1 font-monospace">{{ $perangkat->nip }}</p>
                </div>
                @endif

                @if($perangkat->kontak)
                <div class="mb-2">
                    <small class="text-muted">Kontak:</small>
                    <p class="mb-1">
                        <i class="fas fa-phone me-1"></i>{{ $perangkat->kontak }}
                    </p>
                </div>
                @endif

                <div class="mb-2">
                    <small class="text-muted">Periode Mulai:</small>
                    <p class="mb-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ isset($perangkat->periode_mulai) ? \Carbon\Carbon::parse($perangkat->periode_mulai)->format('d M Y') : 'N/A' }}
                    </p>
                </div>

                @if($perangkat->periode_selesai)
                <div class="mb-2">
                    <small class="text-muted">Periode Selesai:</small>
                    <p class="mb-1">
                        <i class="fas fa-calendar-check me-1"></i>
                        {{ \Carbon\Carbon::parse($perangkat->periode_selesai)->format('d M Y') }}
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
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-primary mb-0">{{ $perangkat->perangkat_id }}</h6>
                            <small class="text-muted">ID Perangkat</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-success mb-0">{{ $perangkat->warga_id }}</h6>
                        <small class="text-muted">ID Warga</small>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Dibuat: {{ isset($perangkat->created_at) ? \Carbon\Carbon::parse($perangkat->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-user-tie" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data perangkat desa</h5>
                <p class="text-muted">Belum ada perangkat desa yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Statistik Perangkat Desa
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-primary">{{ $perangkats->count() }}</h4>
                        <p class="text-muted mb-0">Total Perangkat</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-success">{{ $perangkats->whereNull('periode_selesai')->count() }}</h4>
                        <p class="text-muted mb-0">Aktif</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-info">{{ $perangkats->whereNotNull('nip')->count() }}</h4>
                        <p class="text-muted mb-0">Memiliki NIP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection