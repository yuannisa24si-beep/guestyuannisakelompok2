@extends('guest.layout')

@section('title', 'Data RW')
@section('page-title', 'Data RW')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-map-marked-alt"></i> Data RW
        </h2>
    </div>
</div>

<div class="row">
    @forelse($rws as $rw)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-map-marked-alt me-2"></i>
                    RW {{ $rw->nomor_rw }}
                </h6>
            </div>
            <div class="card-body">
                @if($rw->ketua_nama)
                <div class="mb-3">
                    <small class="text-muted">Ketua RW:</small>
                    <p class="mb-1 fw-bold text-primary">
                        <i class="fas fa-user me-1"></i>{{ $rw->ketua_nama }}
                    </p>
                </div>
                @endif
                
                @if($rw->keterangan)
                <div class="mb-3">
                    <small class="text-muted">Keterangan:</small>
                    <p class="mb-1">{{ $rw->keterangan }}</p>
                </div>
                @endif

                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-primary mb-0">{{ $rw->rw_id }}</h6>
                            <small class="text-muted">ID RW</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-success mb-0">{{ $rw->ketua_rw_warga_id ?? 'N/A' }}</h6>
                        <small class="text-muted">ID Ketua</small>
                    </div>
                </div>

                @if($rw->ketua_nama)
                <div class="mt-3 p-2 bg-light rounded">
                    <small class="text-muted">Info Ketua:</small>
                    <div class="d-flex justify-content-between">
                        <span>{{ $rw->ketua_nama }}</span>
                        <span>{{ $rw->telp ?? 'No telp' }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Dibuat: {{ isset($rw->created_at) ? \Carbon\Carbon::parse($rw->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-map-marked-alt" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data RW</h5>
                <p class="text-muted">Belum ada RW yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Statistik RW
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-primary">{{ $rws->count() }}</h4>
                        <p class="text-muted mb-0">Total RW</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-success">{{ $rws->whereNotNull('ketua_rw_warga_id')->count() }}</h4>
                        <p class="text-muted mb-0">Memiliki Ketua</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-info">{{ $rws->whereNotNull('keterangan')->count() }}</h4>
                        <p class="text-muted mb-0">Ada Keterangan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection