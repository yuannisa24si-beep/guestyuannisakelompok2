@extends('layouts.app')

@section('title', 'Data RT')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Data RT</h2>
    </div>
    
    <div class="row">
        @forelse($rt as $rtItem)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #8b5cf6;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-warning mb-0">RT {{ $rtItem->nomor_rt }}</h5>
                        <i class="fas fa-home fa-2x text-warning"></i>
                    </div>
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
</div>
@endsection

