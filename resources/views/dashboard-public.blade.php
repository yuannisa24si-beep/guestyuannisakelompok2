@extends('layouts.app')

@section('title', 'Dashboard - Data Desa')

@section('content')
<style>
    .dashboard-container {
        padding: 40px 0;
        background: #f5f7fa;
        min-height: 100vh;
    }
    
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .welcome-banner h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .welcome-banner p {
        font-size: 1.1rem;
        opacity: 0.95;
    }
    
    .status-badge {
        background: #10b981;
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        display: inline-block;
        margin-top: 10px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        border-top: 4px solid;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    
    .stat-card.border-primary { border-top-color: #3b82f6; }
    .stat-card.border-success { border-top-color: #10b981; }
    .stat-card.border-warning { border-top-color: #f59e0b; }
    .stat-card.border-danger { border-top-color: #ef4444; }
    .stat-card.border-purple { border-top-color: #8b5cf6; }
    .stat-card.border-pink { border-top-color: #ec4899; }
    .stat-card.border-blue { border-top-color: #06b6d4; }
    .stat-card.border-orange { border-top-color: #f97316; }
    
    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .stat-card-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-card-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }
    
    .stat-card-icon.bg-primary { background: #3b82f6; }
    .stat-card-icon.bg-success { background: #10b981; }
    .stat-card-icon.bg-warning { background: #f59e0b; }
    .stat-card-icon.bg-danger { background: #ef4444; }
    .stat-card-icon.bg-purple { background: #8b5cf6; }
    .stat-card-icon.bg-pink { background: #ec4899; }
    .stat-card-icon.bg-blue { background: #06b6d4; }
    .stat-card-icon.bg-orange { background: #f97316; }
    
    .stat-card-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 5px;
    }
    
    .stat-card-description {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 15px;
    }
    
    .stat-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-detail {
        background: transparent;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s;
    }
    
    .btn-detail:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        color: #374151;
    }
    
    .page-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .page-title i {
        color: #667eea;
    }
</style>

<div class="dashboard-container">
    <div class="container">
        <!-- Page Title -->
        <div class="page-title">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </div>
        
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Selamat Datang!</h2>
                    <p>Anda sedang melihat data desa | Sistem berjalan normal</p>
                </div>
                <div>
                    <span class="status-badge">
                        <i class="fas fa-circle" style="font-size: 0.6rem; margin-right: 5px;"></i>
                        Online
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <!-- Total Warga -->
            <div class="stat-card border-primary">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Total Warga</div>
                    </div>
                    <div class="stat-card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalWarga) }}</div>
                <div class="stat-card-description">Data terbaru</div>
                <div class="stat-card-footer">
                    <a href="{{ route('warga.index') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Total User -->
            <div class="stat-card border-success">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Total User</div>
                    </div>
                    <div class="stat-card-icon bg-success">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalUser) }}</div>
                <div class="stat-card-description">Pengguna aktif</div>
                <div class="stat-card-footer">
                    <a href="#" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Lembaga Desa -->
            <div class="stat-card border-warning">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Lembaga Desa</div>
                    </div>
                    <div class="stat-card-icon bg-warning">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalLembagaDesa) }}</div>
                <div class="stat-card-description">Organisasi aktif</div>
                <div class="stat-card-footer">
                    <a href="{{ route('data.cards') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Perangkat Desa -->
            <div class="stat-card border-danger">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Perangkat Desa</div>
                    </div>
                    <div class="stat-card-icon bg-danger">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalPerangkatDesa) }}</div>
                <div class="stat-card-description">Aparatur desa</div>
                <div class="stat-card-footer">
                    <a href="{{ route('data.cards') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Total RT -->
            <div class="stat-card border-purple">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Total RT</div>
                    </div>
                    <div class="stat-card-icon bg-purple">
                        <i class="fas fa-home"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalRt) }}</div>
                <div class="stat-card-description">Rukun Tetangga</div>
                <div class="stat-card-footer">
                    <a href="{{ route('data.cards') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Total RW -->
            <div class="stat-card border-blue">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Total RW</div>
                    </div>
                    <div class="stat-card-icon bg-blue">
                        <i class="fas fa-city"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalRw) }}</div>
                <div class="stat-card-description">Rukun Warga</div>
                <div class="stat-card-footer">
                    <a href="{{ route('data.cards') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Total Jabatan -->
            <div class="stat-card border-orange">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Total Jabatan</div>
                    </div>
                    <div class="stat-card-icon bg-orange">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalJabatan) }}</div>
                <div class="stat-card-description">Posisi jabatan</div>
                <div class="stat-card-footer">
                    <a href="{{ route('jabatan.public') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
            
            <!-- Anggota Lembaga -->
            <div class="stat-card border-pink">
                <div class="stat-card-header">
                    <div>
                        <div class="stat-card-title">Anggota Lembaga</div>
                    </div>
                    <div class="stat-card-icon bg-pink">
                        <i class="fas fa-users-cog"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalAnggotaLembaga) }}</div>
                <div class="stat-card-description">Anggota aktif</div>
                <div class="stat-card-footer">
                    <a href="{{ route('data.cards') }}" class="btn-detail">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

