@extends('layouts.app')

@section('title', 'Data Warga')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Data Warga</h2>
    </div>
    
    <div class="row">
        @forelse($wargas as $warga)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #3b82f6;">
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fa fa-user fa-3x text-white"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $warga->nama }}</h5>
                    <p class="card-text">
                        <strong>NIK:</strong> {{ $warga->nik ?? '-' }}<br>
                        <strong>Email:</strong> {{ $warga->email ?? '-' }}<br>
                        <strong>Alamat:</strong> {{ $warga->alamat ?? '-' }}<br>
                        <strong>Telepon:</strong> {{ $warga->telepon ?? '-' }}<br>
                        <strong>Role:</strong> {{ $warga->role ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Belum ada data Warga</div>
        </div>
        @endforelse
    </div>
    
    @if($wargas->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $wargas->links() }}
    </div>
    @endif
</div>
@endsection

