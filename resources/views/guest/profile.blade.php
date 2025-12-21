@extends('guest.layout')

@section('title', 'Profile Guest')
@section('page-title', 'Profile')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-user-circle"></i> Informasi Profile
        </h2>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Informasi Profile
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-user-circle" style="font-size: 6rem; color: var(--primary-purple);"></i>
                        </div>
                        <h5>Guest User</h5>
                        <p class="text-muted">Mode Tamu</p>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama:</label>
                            <p class="fw-bold">Guest</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Email:</label>
                            <p class="fw-bold">nisa@gmail.com</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Role:</label>
                            <span class="badge badge-purple">
                                <i class="fas fa-eye me-1"></i>Guest
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Terdaftar Sejak:</label>
                            <p class="fw-bold">15 December 2025 17:50</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Terakhir Diperbarui:</label>
                            <p class="fw-bold">15 December 2025 17:50</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- System Information -->
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-cog"></i> Informasi Sistem
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <h6 class="text-primary">Laravel</h6>
                        <p class="text-muted mb-0">Framework</p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-success">MySQL</h6>
                        <p class="text-muted mb-0">Database</p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-info">Bootstrap 5</h6>
                        <p class="text-muted mb-0">UI Framework</p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-warning">Guest Mode</h6>
                        <p class="text-muted mb-0">Access Level</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection