@extends('guest.layout')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-users"></i> Users
        </h2>
    </div>
</div>

<div class="row">
    @forelse($users as $user)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    {{ $user->name }}
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <small class="text-muted">Email:</small>
                    <p class="mb-1">
                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                    </p>
                </div>
                
                <div class="mb-2">
                    <small class="text-muted">Role:</small>
                    <p class="mb-1">
                        @if($user->role == 'admin')
                            <span class="badge bg-danger">
                                <i class="fas fa-user-shield me-1"></i>{{ ucfirst($user->role) }}
                            </span>
                        @else
                            <span class="badge bg-primary">
                                <i class="fas fa-user me-1"></i>{{ ucfirst($user->role) }}
                            </span>
                        @endif
                    </p>
                </div>

                <div class="row text-center mt-3">
                    <div class="col-12">
                        <h6 class="text-primary mb-0">{{ $users->id }}</h6>
                        <small class="text-muted">Users ID</small>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Bergabung: {{ isset($user->created_at) ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : 'N/A' }}
                </small>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-users" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">Tidak ada data users</h5>
                <p class="text-muted">Belum ada users yang terdaftar dalam sistem.</p>
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
                    <i class="fas fa-chart-pie"></i> Statistik Users
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-primary">{{ $users->count() }}</h4>
                        <p class="text-muted mb-0">Total Users</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-danger">{{ $users->where('role', 'admin')->count() }}</h4>
                        <p class="text-muted mb-0">Admin</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-success">{{ $users->where('role', 'warga')->count() }}</h4>
                        <p class="text-muted mb-0">Warga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Catatan:</strong> Halaman ini hanya menampilkan daftar users. Untuk mengelola users, silakan hubungi administrator.
        </div>
    </div>
</div>
@endsection