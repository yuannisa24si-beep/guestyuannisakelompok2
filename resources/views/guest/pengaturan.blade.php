@extends('guest.layout')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="page-title">
            <i class="fas fa-cog"></i> Pengaturan
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-database me-2"></i>
                    Informasi Database
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Database Name:</small>
                    <p class="mb-1 font-monospace">{{ config('database.connections.mysql.database') }}</p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Host:</small>
                    <p class="mb-1 font-monospace">{{ config('database.connections.mysql.host') }}</p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Port:</small>
                    <p class="mb-1 font-monospace">{{ config('database.connections.mysql.port') }}</p>
                </div>
                <a href="/test-database" class="btn btn-purple btn-sm" target="_blank">
                    <i class="fas fa-vial me-1"></i> Test Database Connection
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Aplikasi
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">App Name:</small>
                    <p class="mb-1">{{ config('app.name') }}</p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Environment:</small>
                    <p class="mb-1">
                        <span class="badge bg-{{ config('app.env') == 'production' ? 'success' : 'warning' }}">
                            {{ strtoupper(config('app.env')) }}
                        </span>
                    </p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Debug Mode:</small>
                    <p class="mb-1">
                        <span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">
                            {{ config('app.debug') ? 'ON' : 'OFF' }}
                        </span>
                    </p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Laravel Version:</small>
                    <p class="mb-1">{{ app()->version() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Catatan:</strong> Halaman ini hanya menampilkan informasi sistem. Untuk mengubah pengaturan, silakan hubungi administrator.
        </div>
    </div>
</div>
@endsection
