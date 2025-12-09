{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Beranda Lembaga')

{{-- 🆕 BLOK BARU: Tombol Profil dan Logout --}}
@auth
<div class="user-profile-info">
    {{-- Tautan ke Halaman Profil --}}
    <a href="{{ url('profile') }}" class="btn-profile">
        <i class="fa fa-user"></i>
        Hai, **{{ Auth::user()->nama }}**
    </a>
    
    {{-- Tautan Logout (Pastikan menggunakan rute 'auth.logout') --}}
    <a href="{{ route('auth.logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn-logout">
        Keluar
    </a>
    
    {{-- Form tersembunyi untuk POST logout request (Pastikan menggunakan rute 'auth.logout') --}}
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endauth
{{-- 🔚 AKHIR BLOK BARU --}}

{{-- Section untuk konten Hero Slider --}}
@section('hero_slider')
  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Sistem Informasi Jabatan Lembaga
                  </h1>
                  <p>
                    Transparansi dan akses mudah terhadap informasi struktur organisasi, jabatan, dan fungsi setiap unit di Lembaga kami untuk mendukung tata kelola yang baik.
                  </p>
                  <div class="btn-box">
                    <a href="{{ url('jabatan') }}" class="btn1">
                      Lihat Jabatan
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- Carousel items lainnya... --}}
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </div>

  </section>
  @endsection

{{-- Section untuk konten utama halaman --}}
@section('content')

  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="row">
          <div class="col-md-6">
            <div class="box">
              <div class="img-box">
                {{-- PATH DIPERBARUI: public/assets/images/o1.jpg (Ganti gambar jika ada yang lebih sesuai) --}}
                <img src="{{ asset('assets/images/gambar3.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Data Terbaru
                </h5>
                <h6>
                  <span>20%</span> Lebih Cepat
                </h6>
                <a href="{{ url('jabatan') }}">
                  Lihat Jabatan <i class="fa fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box">
              <div class="img-box">
                {{-- PATH DIPERBARUI: public/assets/images/o2.jpg (Ganti gambar jika ada yang lebih sesuai) --}}
                <img src="{{ asset('assets/images/gambar4.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Dokumen
                </h5>
                <h6>
                  <span>15%</span> Lebih Banyak
                </h6>
                <a href="{{ url('kontak') }}">
                  Minta Akses <i class="fa fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Jabatan Pimpinan Utama
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">Semua</li>
        <li data-filter=".pk">Pimpinan</li>
        <li data-filter=".fk">Fungsional</li>
        <li data-filter=".staf">Staf</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          {{-- Konten Jabatan 1 --}}
          <div class="col-sm-6 col-lg-4 all pk">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/gambar5.jpg') }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>Kepala Lembaga (Level 1)</h5>
                  <p>
                    Memimpin dan bertanggung jawab penuh atas seluruh Lembaga.
                  </p>
                  <div class="options">
                    <h6>Kode: JBT001</h6>
                    <a href="#">
                      <i class="fa fa-info-circle"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Konten Jabatan 2 --}}
          <div class="col-sm-6 col-lg-4 all pk">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/gambar6.jpg') }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>Sekretaris Utama (Level 2)</h5>
                  <p>
                    Mengelola administrasi dan mendukung fungsi pimpinan.
                  </p>
                  <div class="options">
                    <h6>Kode: JBT005</h6>
                    <a href="#">
                      <i class="fa fa-info-circle"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Konten Jabatan 3 --}}
          <div class="col-sm-6 col-lg-4 all fk">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/gambar7.jpg') }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>Analis Kebijakan (Level 4)</h5>
                  <p>
                    Melakukan kajian mendalam terhadap kebijakan Lembaga.
                  </p>
                  <div class="options">
                    <h6>Kode: JBT015</h6>
                    <a href="#">
                      <i class="fa fa-info-circle"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="btn-box">
        <a href="{{ url('jabatan') }}">
          Lihat Semua Jabatan
        </a>
      </div>
    </div>
  </section>

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            {{-- PATH DIPERBARUI: public/assets/images/about-img.png --}}
            <img src="{{ asset('assets/images/gambar2.jpg') }}" alt="Ilustrasi Lembaga">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Tentang Lembaga Kami
              </h2>
            </div>
            <p>
              Kami berkomitmen untuk menyediakan layanan publik yang akuntabel dan transparan. Sistem ini adalah bagian dari inisiatif digitalisasi untuk memudahkan akses informasi publik terkait struktur organisasi dan alur pertanggungjawaban di Lembaga.
            </p>
            <a href="{{ url('tentang') }}">
              Baca Selengkapnya
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Kontak dan Permintaan Data
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="">
              <div>
                <input type="text" class="form-control" placeholder="Nama Anda" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Nomor Telepon" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email Anda" />
              </div>
              <div>
                <select class="form-control nice-select wide">
                  <option value="" disabled selected>
                    Tujuan Kontak?
                  </option>
                  <option value="">
                    Permintaan Data Jabatan
                  </option>
                  <option value="">
                    Pertanyaan Umum
                  </option>
                  <option value="">
                    Kritik & Saran
                  </option>
                </select>
              </div>
              <div>
                <textarea class="form-control" rows="3" placeholder="Pesan Anda..."></textarea>
              </div>
              <div class="btn_box mt-4">
                <button>
                  Kirim Pesan
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <div id="googleMap"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection