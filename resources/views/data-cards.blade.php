@extends('layouts.app')

@section('title', 'Data Card - Informasi Desa')

@section('content')
<div class="container" style="padding: 60px 0;">
    
    <!-- Section Lembaga Desa -->
    <section class="mb-5">
        <div class="heading_container heading_center mb-4">
            <h2>Lembaga Desa</h2>
        </div>
        <div class="row">
            @forelse($lembagaDesa as $lembaga)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $lembaga->nama_lembaga }}</h5>
                        <p class="card-text">{{ $lembaga->deskripsi ?? '-' }}</p>
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fa fa-phone"></i> {{ $lembaga->kontak ?? '-' }}
                            </small>
                        </div>
                        @if($lembaga->jabatans->count() > 0)
                        <div class="mt-2">
                            <small class="badge bg-info">{{ $lembaga->jabatans->count() }} Jabatan</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada data Lembaga Desa</div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section Perangkat Desa -->
    <section class="mb-5">
        <div class="heading_container heading_center mb-4">
            <h2>Perangkat Desa</h2>
        </div>
        <div class="row">
            @forelse($perangkatDesa as $perangkat)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    @if($perangkat->foto)
                    <img src="{{ asset('storage/' . $perangkat->foto) }}" class="card-img-top" alt="Foto" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fa fa-user fa-3x text-white"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $perangkat->warga->nama ?? 'N/A' }}</h5>
                        <p class="card-text">
                            <strong>Jabatan:</strong> {{ $perangkat->jabatan }}<br>
                            <strong>NIP:</strong> {{ $perangkat->nip ?? '-' }}<br>
                            <strong>Kontak:</strong> {{ $perangkat->kontak ?? '-' }}
                        </p>
                        <div class="mt-2">
                            <small class="text-muted">
                                Periode: {{ $perangkat->periode_mulai ? $perangkat->periode_mulai->format('d/m/Y') : '-' }} 
                                @if($perangkat->periode_selesai)
                                - {{ $perangkat->periode_selesai->format('d/m/Y') }}
                                @else
                                - Sekarang
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada data Perangkat Desa</div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section RW -->
    <section class="mb-5">
        <div class="heading_container heading_center mb-4">
            <h2>Data RW</h2>
        </div>
        <div class="row">
            @forelse($rw as $rwItem)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <div class="card-body">
                        <h5 class="card-title text-success">RW {{ $rwItem->nomor_rw }}</h5>
                        <p class="card-text">
                            <strong>Ketua RW:</strong> {{ $rwItem->ketuaRw->nama ?? '-' }}<br>
                            <strong>Keterangan:</strong> {{ $rwItem->keterangan ?? '-' }}
                        </p>
                        @if($rwItem->rts->count() > 0)
                        <div class="mt-2">
                            <small class="badge bg-success">{{ $rwItem->rts->count() }} RT</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada data RW</div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section RT -->
    <section class="mb-5">
        <div class="heading_container heading_center mb-4">
            <h2>Data RT</h2>
        </div>
        <div class="row">
            @forelse($rt as $rtItem)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <div class="card-body">
                        <h5 class="card-title text-warning">RT {{ $rtItem->nomor_rt }}</h5>
                        <p class="card-text">
                            <strong>RW:</strong> {{ $rtItem->rw->nomor_rw ?? '-' }}<br>
                            <strong>Ketua RT:</strong> {{ $rtItem->ketuaRt->nama ?? '-' }}<br>
                            <strong>Keterangan:</strong> {{ $rtItem->keterangan ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada data RT</div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Section Anggota Lembaga -->
    <section class="mb-5">
        <div class="heading_container heading_center mb-4">
            <h2>Anggota Lembaga</h2>
        </div>
        <div class="row">
            @forelse($anggotaLembaga as $anggota)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anggota->warga->nama ?? 'N/A' }}</h5>
                        <p class="card-text">
                            <strong>Lembaga:</strong> {{ $anggota->lembaga->nama_lembaga ?? '-' }}<br>
                            <strong>Jabatan:</strong> {{ $anggota->jabatan->nama_jabatan ?? '-' }}<br>
                            <strong>Status:</strong> 
                            <span class="badge {{ $anggota->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($anggota->status) }}
                            </span>
                        </p>
                        <div class="mt-2">
                            <small class="text-muted">
                                Periode: {{ $anggota->periode_formatted }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada data Anggota Lembaga</div>
            </div>
            @endforelse
        </div>
    </section>

</div>

<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.heading_container h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #333;
}
</style>
@endsection



