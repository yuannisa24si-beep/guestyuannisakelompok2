<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title', 'Feane')</title>

    <!-- CSS -->
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">


</head>

<body>

    <!-- HERO AREA (Background + Navbar) -->
    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets/images/hero-bg.jpg') }}" alt="">
        </div>

        <!-- Header/Navbar -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>Feane</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                        <span class=""></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item {{ request()->is('menu') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/menu') }}">Menu</a>
                            </li>
                            <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/about') }}">About</a>
                            </li>
                            <li class="nav-item {{ request()->is('book') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/book') }}">Book Table</a>
                            </li>
                        </ul>

                        <div class="user_option">
                            <a href="#" class="user_link">
                                <i class="fa fa-user"></i>
                            </a>

                            <a href="#" class="cart_link">
                                <i class="fa fa-shopping-cart"></i>
                            </a>

                            <form class="form-inline">
                                <button class="btn nav_search-btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>

                            <a href="#" class="order_online">Order Online</a>
                        </div>

                    </div>
                </nav>
            </div>
        </header>

        {{-- SECTION KHUSUS UNTUK SLIDER --}}
        @yield('slider')

    </div> <!-- end hero_area -->

    {{-- KONTEN UTAMA --}}
    @yield('content')


    <!-- Footer -->
    <footer class="footer_section">
        <div class="container">
            <p class="text-center mt-3">
                &copy; {{ date('Y') }} All Rights Reserved By Feane
            </p>
        </div>
    </footer>

    <li class="nav-item @if(Request::is('about')) active @endif">
    <a class="nav-link" href="{{ url('about') }}">About</a>
</li>


    <!-- JS -->
   <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>


</body>

</html>
