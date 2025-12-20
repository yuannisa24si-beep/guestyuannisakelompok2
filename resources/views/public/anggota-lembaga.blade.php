@extends('layouts.app')

@section('title', 'Anggota Lembaga')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Anggota Lembaga</h2>
    </div>
    
    <div class="row">
        @forelse($anggotaLembaga as $anggota)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #ec4899;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $anggota->warga->nama ?? 'N/A' }}</h5>
                        <i class="fas fa-users-cog fa-2x text-pink"></i>
                    </div>
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
</div>
@endsection

