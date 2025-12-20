@extends('layouts.app')

@section('title', 'Perangkat Desa')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Perangkat Desa</h2>
    </div>
    
    <div class="row">
        @forelse($perangkatDesa as $perangkat)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #ef4444;">
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
</div>
@endsection

