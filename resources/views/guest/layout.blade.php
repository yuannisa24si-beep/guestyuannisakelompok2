<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIDESA - Sistem Informasi Desa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-purple: #7c3aed;
            --secondary-purple: #a78bfa;
            --light-purple: #ede9fe;
            --dark-purple: #5b21b6;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .top-navbar {
            background: linear-gradient(135deg, var(--dark-purple) 0%, var(--primary-purple) 100%);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo-section {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            font-family: 'Arial Black', Arial, sans-serif;
            font-weight: 900;
        }

        .logo::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: rotate(45deg);
            animation: logoShine 3s ease-in-out infinite;
        }

        @keyframes logoShine {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .logo-text {
            font-size: 2rem;
            color: white;
            z-index: 2;
            position: relative;
            font-weight: 900;
        }

        .logo-star {
            position: absolute;
            right: 8px;
            bottom: 8px;
            font-size: 0.8rem;
            color: white;
            z-index: 3;
        }

        .brand-text {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }

        .brand-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            margin: 0;
        }

        .nav-menu {
            background: white;
            padding: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-menu .nav-link {
            color: var(--dark-purple);
            padding: 15px 20px;
            font-weight: 500;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
            text-decoration: none;
            cursor: pointer;
            display: block;
        }

        .nav-menu .nav-link:hover {
            background-color: var(--light-purple);
            color: var(--primary-purple);
            border-bottom-color: var(--primary-purple);
        }

        .nav-menu .nav-link.active {
            background-color: var(--primary-purple);
            color: white;
            border-bottom-color: var(--dark-purple);
        }

        .nav-menu .nav-link i {
            margin-right: 8px;
        }

        .user-info {
            display: flex;
            align-items: center;
            color: white;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .user-avatar i {
            color: white;
            font-size: 1.2rem;
        }

        .user-details h6 {
            margin: 0;
            font-size: 0.9rem;
        }

        .user-details small {
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
        }

        .content-wrapper {
            padding: 30px;
            min-height: calc(100vh - 140px);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(124, 58, 237, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
        }

        .btn-purple {
            background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-purple:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.4);
            color: white;
        }

        .badge-purple {
            background-color: var(--primary-purple);
            color: white;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
        }

        .stat-card i {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .page-title {
            color: var(--dark-purple);
            font-weight: 600;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .nav-menu {
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }
            
            .nav-menu .d-flex {
                flex-wrap: nowrap !important;
            }
            
            .nav-menu .nav-link {
                display: inline-block;
                padding: 12px 15px;
                white-space: nowrap;
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <nav class="top-navbar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="logo-section">
                        <div class="logo">
                            <span class="logo-text">P</span>
                            <i class="fas fa-star logo-star"></i>
                        </div>
                        <div>
                            <h5 class="brand-text">SIDESA</h5>
                            <p class="brand-subtitle">Sistem Informasi Desa Digital</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="user-details">
                            <h6>Portal Publik</h6>
                            <small>Akses Terbuka</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Navigation Menu -->
    <nav class="nav-menu">
        <div class="container-fluid">
            <div class="d-flex flex-wrap">
                <a class="nav-link {{ request()->routeIs('guest.dashboard') ? 'active' : '' }}" href="{{ route('guest.dashboard') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('guest.lembaga-desa') ? 'active' : '' }}" href="{{ route('guest.lembaga-desa') }}">
                    <i class="fas fa-building"></i> Lembaga Desa
                </a>
                <a class="nav-link {{ request()->routeIs('guest.jabatan') ? 'active' : '' }}" href="{{ route('guest.jabatan') }}">
                    <i class="fas fa-briefcase"></i> Jabatan
                </a>
                <a class="nav-link {{ request()->routeIs('guest.perangkat-desa') ? 'active' : '' }}" href="{{ route('guest.perangkat-desa') }}">
                    <i class="fas fa-user-tie"></i> Perangkat Desa
                </a>
                <a class="nav-link {{ request()->routeIs('guest.warga') ? 'active' : '' }}" href="{{ route('guest.warga') }}">
                    <i class="fas fa-users"></i> Data Warga
                </a>
                <a class="nav-link {{ request()->routeIs('guest.rw') ? 'active' : '' }}" href="{{ route('guest.rw') }}">
                    <i class="fas fa-map-marked-alt"></i> Data RW
                </a>
                <a class="nav-link {{ request()->routeIs('guest.rt') ? 'active' : '' }}" href="{{ route('guest.rt') }}">
                    <i class="fas fa-map-marker-alt"></i> Data RT
                </a>
                <a class="nav-link {{ request()->routeIs('guest.anggota-lembaga') ? 'active' : '' }}" href="{{ route('guest.anggota-lembaga') }}">
                    <i class="fas fa-users-cog"></i> Anggota Lembaga
                </a>
                <a class="nav-link {{ request()->routeIs('guest.pengaturan') ? 'active' : '' }}" href="{{ route('guest.pengaturan') }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
                <a class="nav-link {{ request()->routeIs('guest.users') ? 'active' : '' }}" href="{{ route('guest.users') }}">
                    <i class="fas fa-users"></i> Users
                </a>
                <a class="nav-link {{ request()->routeIs('guest.profile') ? 'active' : '' }}" href="{{ route('guest.profile') }}">
                    <i class="fas fa-user-circle"></i> Profile
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ensure all navigation links are clickable
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers to navigation links
            const navLinks = document.querySelectorAll('.nav-menu .nav-link');
            navLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    // Allow normal navigation
                    console.log('Navigating to:', this.href);
                });
            });
            
            // Debug: Log all navigation links
            console.log('Navigation links found:', navLinks.length);
            navLinks.forEach(function(link, index) {
                console.log(`Link ${index + 1}:`, link.textContent.trim(), '→', link.href);
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
