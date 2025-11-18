{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Beranda Lembaga')

{{-- Area Head Extra: Menambahkan style khusus untuk Hero Section. --}}
@section('head_extra')
<style>
  /* Menyesuaikan tinggi hero section agar gambar pas */
  .hero_area {
    height: auto; /* Izinkan tinggi menyesuaikan konten */
    min-height: 500px; /* Tinggi minimal agar hero section terlihat */
    display: flex; /* Menggunakan flexbox untuk penempatan konten */
    align-items: center; /* Pusatkan konten secara vertikal */
    padding-bottom: 75px; /* Tambahkan padding agar footer tidak terlalu dekat */
  }

  /* Styling untuk background hero image */
  .hero_area .bg-box img {
    object-fit: cover; /* Pastikan gambar menutupi area tanpa terdistorsi */
    height: 100%;
    width: 100%;
    position: absolute; /* Posisikan absolut agar mengisi seluruh parent */
    top: 0;
    left: 0;
    filter: brightness(0.5); /* Gelapkan sedikit agar teks mudah dibaca */
  }

  /* Memastikan konten hero berada di atas gambar background */
  .slider_section .detail-box {
    position: relative;
    z-index: 2; /* Pastikan teks di atas gambar background */
    color: #fff; /* Pastikan warna teks putih agar terbaca */
    text-shadow: 2px 2px 4px rgba(0,0,0,0.7); /* Tambahkan shadow agar lebih jelas */
  }

  /* Hapus carousel indicators karena tidak lagi menggunakan slider */
  .carousel-indicators {
    display: none;
  }

  /* Custom styling untuk kotak informasi cepat */
  .info-box {
    background: #222831;
    color: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    min-height: 150px;
  }
  .info-box .icon-box {
    background: #ffbe2b;
    border-radius: 50%;
    padding: 15px;
    margin-right: 20px;
  }
  .info-box .icon-box i {
    font-size: 2rem;
    color: #222831;
  }
</style>
@endsection

{{-- Section untuk konten Hero (hero statis) --}}
@section('hero_slider')
  <!-- hero section (menggantikan slider section) -->
  <section class="slider_section ">
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
  </section>
  <!-- end hero section -->
@endsection

{{-- Section untuk konten utama halaman --}}
@section('content')

  <!-- offer section (Informasi Cepat) -->
  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="row">
          <div class="col-md-6 mt-4">
            <div class="info-box">
              <div class="icon-box">
                <i class="fa fa-line-chart"></i>
              </div>
              <div class="detail-box">
                <h5>
                  Data Terbaru
                </h5>
                <h6>
                  <span>20%</span> Lebih Cepat Diperbarui
                </h6>
                <a href="{{ url('jabatan') }}" class="text-warning small text-decoration-none">
                  Lihat Jabatan <i class="fa fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-4">
            <div class="info-box">
              <div class="icon-box">
                <i class="fa fa-folder-open-o"></i>
              </div>
              <div class="detail-box">
                <h5>
                  Dokumen
                </h5>
                <h6>
                  <span>15%</span> Lebih Banyak Tersedia
                </h6>
                <a href="{{ url('kontak') }}" class="text-warning small text-decoration-none">
                  Minta Akses <i class="fa fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end offer section -->

  <!-- food section (Jabatan Pimpinan Utama - Preview Statis) -->
  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Jabatan Pimpinan Utama
        </h2>
      </div>
      
      {{-- Konten ini STATIS dan hanya sebagai PREVIEW, bukan dari database --}}
      <div class="filters-content">
        <div class="row grid">
          {{-- Konten Jabatan 1 (STATIS) --}}
          <div class="col-sm-6 col-lg-4 all pk">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/f1.png') }}" alt="">
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
          {{-- Konten Jabatan 2 (STATIS) --}}
          <div class="col-sm-6 col-lg-4 all pk">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/f2.png') }}" alt="">
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
          {{-- Konten Jabatan 3 (STATIS) --}}
          <div class="col-sm-6 col-lg-4 all fk">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('assets/images/f3.png') }}" alt="">
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
      <div class="btn-box mt-4">
        <a href="{{ url('jabatan') }}">
          Lihat Semua Jabatan
        </a>
      </div>
    </div>
  </section>
  <!-- end food section -->

  <!-- about section (Tentang Kami Preview) -->
  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            {{-- PATH DIPERBARUI: public/assets/images/about-img.png --}}
            <img src="{{ asset('assets/images/about-img.png') }}" alt="Ilustrasi Lembaga">
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
  <!-- end about section -->

  <!-- book section (Kontak Preview) -->
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
  <!-- end book section -->

@endsection