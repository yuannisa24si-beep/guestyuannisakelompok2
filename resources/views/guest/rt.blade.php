@extends('guest.layout')

@section('title', 'Data RT')
@section('page-title', 'Data RT')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-map-marker-alt"></i> Data RT
        </h2>
    </div>
</div>

<div class="row">
    @forelse($rts as $rt)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    RT {{ $rt->nomor_rt }} / RW {{ $rt->nomor_rw ?? 'N/A' }}
                </h6>
            </div>
            <div class="card-body">
                @if($rt->ketua_rt_nama)
                <div class="mb-3">
                    <small class="text-muted">Ketua RT:</small>
                    <p class="mb-1 fw-bold text-primary">
                        <i class="fas fa-user me-1"></i>{{ $rt->ketua_rt_nama }}
                    </p>
                </div>
                @endif

                @if($rt->nomor_rw)
                <div class="mb-3">
                    <small class="text-muted">RW:</small>
                    <p class="mb-1">
                        <i class="fas fa-map-marked-alt me-1"></i>
                        RW {{ $rt->nomor_rw }}
                        @if($rt->ketua_rw_nama)
                            <br><small class="text-muted">Ketua RW: {{ $rt->ketua_rw_nama }}</small>
                        @endif
                    </p>
                </div>
                @endif
                
                @if($rt->keterangan)
                <div class="mb-3">
                    <small class="text-muted">Keterangan:</small>
                    <p class="mb-1">{{ $rt->keterangan }}</p>
                </div>
                @endif

                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="border-end">
                            <h6 class="text-primary mb-0">{{ $rt->rt_id }}</h6>
                            <small class="text-muted">ID RT</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="text-success mb-0">{{ $rt->ketua_rt_warga_id ?? 'N/A' }}</h6>
                        <small class="text-muted">ID Ketua</small>
                    </div>
                </div>

                @if($rt->ketua_rt_nama)
                <div class="mt-3 p-2 bg-light rounded">
                    <small class="text-muted">Info Ketua RT:</small>
                    <div class="d-flex justify-content-between">
                        <span>{{ $rt->ketua_rt_nama }}</span>
                        <span>{{ $rt->ketua_rt_telp ?? 'No telp' }}</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Dibuat: {{ isset($rt->created_at) ? \Carbon\Carbon::parse($rt->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data RT</h5>
                <p class="text-muted">Belum ada RT yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Statistik RT
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-primary">{{ $rts->count() }}</h4>
                        <p class="text-muted mb-0">Total RT</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-success">{{ $rts->whereNotNull('ketua_rt_warga_id')->count() }}</h4>
                        <p class="text-muted mb-0">Memiliki Ketua</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-info">{{ $rts->whereNotNull('keterangan')->count() }}</h4>
                        <p class="text-muted mb-0">Ada Keterangan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection