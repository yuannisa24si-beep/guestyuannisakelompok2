@extends('layouts.app')

@section('title', 'Data RW')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Data RW</h2>
    </div>
    
    <div class="row">
        @forelse($rw as $rwItem)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #06b6d4;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title text-success mb-0">RW {{ $rwItem->nomor_rw }}</h5>
                        <i class="fas fa-city fa-2x text-info"></i>
                    </div>
                    <p class="card-text">
                        <strong>Ketua RW:</strong> {{ $rwItem->ketuaRw->nama ?? '-' }}<br>
                        <strong>Keterangan:</strong> {{ $rwItem->keterangan ?? '-' }}
                    </p>
                    @if($rwItem->rts->count() > 0)
                    <div class="mt-2">
                        <span class="badge bg-success">{{ $rwItem->rts->count() }} RT</span>
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
</div>
@endsection

