@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="heading_container heading_center mb-4">
        <h2>Users</h2>
    </div>
    
    <div class="row">
        @forelse($users as $user)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 10px; overflow: hidden; border-top: 4px solid #10b981;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $user->name }}</h5>
                        <i class="fas fa-user fa-2x text-success"></i>
                    </div>
                    <p class="card-text">
                        <strong>Email:</strong> {{ $user->email }}<br>
                        <strong>Role:</strong> 
                        <span class="badge {{ $user->role === 'Admin' ? 'bg-danger' : 'bg-primary' }}">
                            {{ $user->role }}
                        </span>
                    </p>
                    <div class="mt-2">
                        <small class="text-muted">
                            Terdaftar: {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">Belum ada data Users</div>
        </div>
        @endforelse
    </div>
</div>
@endsection

