<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="lembaga, jabatan, struktur" />
  <meta name="description" content="Website informasi struktur jabatan dan lembaga" />
  <meta name="author" content="Lembaga Digital" />
  {{-- PATH DIPERBARUI: public/assets/images/favicon.png (asumsi menggunakan ikon umum) --}}
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="">

  {{-- Menggunakan @yield('title') untuk judul halaman yang dinamis --}}
  <title>@yield('title', 'Sistem Informasi Jabatan Lembaga')</title>

  <!-- Google Fonts Link (Poppins untuk tampilan font yang lebih rapi) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- CSS UTAMA -->
  {{-- PATH DIPERBARUI: public/assets/css/bootstrap.css --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" xintegrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  {{-- PATH DIPERBARUI: public/assets/css/font-awesome.min.css --}}
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  {{-- PATH DIPERBARUI: public/assets/css/style.css --}}
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  {{-- PATH DIPERBARUI: public/assets/css/responsive.css --}}
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />

  <!-- Inline Style untuk Memastikan Font Teraplikasi -->
  <style>
    body {
      font-family: 'Poppins', sans-serif; 
    }
  </style>

  {{-- Area tambahan di head, jika ada style khusus per halaman --}}
  @yield('head_extra')

</head>

<body>

  {{-- DIV hero_area ini MENGANDUNG HEADER DAN BACKGROUND GAMBAR --}}
  <div class="hero_area">
    {{-- Background Box --}}
    <div class="bg-box">
      {{-- PATH DIPERBARUI: public/assets/images/hero-bg.jpg (Ganti dengan background yang lebih umum jika perlu) --}}
      <img src="{{ asset('assets/images/gambar1.jpg') }}" alt="Background Lembaga">
    </div>

    <!-- HEADER SECTION -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span>
              Nama Lembaga
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto ">
              {{-- Navigasi Diperbarui --}}
              <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{ url('/') }}">Beranda <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item @if(request()->is('jabatan')) active @endif">
                <a class="nav-link" href="{{ url('jabatan') }}">Jabatan</a>
              </li>
              <li class="nav-item @if(request()->is('tentang')) active @endif">
                <a class="nav-link" href="{{ url('tentang') }}">Tentang</a>
              </li>
              <li class="nav-item @if(request()->is('kontak')) active @endif">
                <a class="nav-link" href="{{ url('kontak') }}">Kontak</a>
              </li>
              <li class="nav-item">
                {{-- Kita gunakan URL /warga yang menampilkan Daftar Data Warga (image_935bbe.png) --}}
                <a class="nav-link" href="{{ url('warga') }}">WARGA</a> 
              </li>
            </ul>
            <div class="user_option">
              <a href="#" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a class="cart_link" href="#">
                {{-- Mengganti icon cart dengan icon file/dokumen --}}
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
              </a>
              <form class="form-inline">
                <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
              <a href="{{ url('kontak') }}" class="order_online">
                Minta Data
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

    {{-- KEMBALIKAN: Tempatkan slider section di sini --}}
    @yield('hero_slider')
  </div>

  {{-- YIELD CONTENT UTAMA: Semua konten di luar area hero/slider akan dimuat di sini --}}
  @yield('content')

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Hubungi Kami
            </h4>
            <div class="contact_link_box">
              <a href="#">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Lokasi Lembaga
                </span>
              </a>
              <a href="#">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Telepon: +01 1234567890
                </span>
              </a>
              <a href="#">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  email@lembaga.go.id
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="{{ url('/') }}" class="footer-logo">
              Sistem Informasi Jabatan Lembaga
            </a>
            <p>
              Kami menyediakan informasi terbaru mengenai struktur dan posisi jabatan di Lembaga kami.
            </p>
            <div class="footer_social">
              <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Jam Pelayanan
          </h4>
          <p>
            Setiap Hari Kerja
          </p>
          <p>
            08.00 - 16.00 WIB
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> Hak Cipta Dilindungi Oleh
          <a href="https://example.com/">Nama Lembaga</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- JS UTAMA -->
  {{-- PATH DIPERBARUI: public/assets/js/jquery-3.4.1.min.js --}}
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" xintegrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  {{-- PATH DIPERBARUI: public/assets/js/bootstrap.js --}}
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  {{-- PATH DIPERBARUI: public/assets/js/custom.js --}}
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  {{-- Google Map API Key (Asumsi Anda akan mengganti key ini di environment Laravel) --}}
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

  {{-- Area tambahan di akhir body, jika ada script khusus per halaman --}}
  @yield('script_extra')

</body>

</html>