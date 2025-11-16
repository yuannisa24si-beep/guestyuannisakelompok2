{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Tentang Lembaga')

{{-- Area Head Extra: Menambahkan class 'sub_page' ke tag body. --}}
@section('head_extra')
<script>
  // Script untuk menambahkan class 'sub_page' ke body
  document.addEventListener('DOMContentLoaded', function() {
      document.body.classList.add('sub_page');
  });
</script>
@endsection

{{-- Mengosongkan hero_slider karena ini sub-page --}}
@section('hero_slider')
    {{-- Kosongkan Hero Slider untuk Sub Page --}}
@endsection


{{-- Section untuk konten utama halaman (Tentang Lembaga) --}}
@section('content')

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            {{-- PATH DIPERBARUI: public/assets/images/about-img.png --}}
            <img src="{{ asset('assets/images/gambar2.jpg') }}" alt="Ilustrasi Kantor Lembaga">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Visi & Misi Lembaga
              </h2>
            </div>
            <p>
              Lembaga kami didirikan dengan tujuan utama untuk mewujudkan tata kelola pemerintahan yang efisien, transparan, dan akuntabel melalui pemanfaatan teknologi informasi. Kami berkomitmen menyediakan data jabatan dan struktur organisasi yang valid dan mudah diakses oleh publik.
            </p>
            <p>
              **Visi:** Menjadi Lembaga percontohan dalam manajemen informasi kepegawaian dan struktur jabatan digital di Indonesia.
            </p>
            <p>
              **Misi:**
              <ul>
                <li>Mengembangkan sistem informasi jabatan yang terintegrasi.</li>
                <li>Memastikan akurasi dan kemutakhiran data struktur organisasi.</li>
                <li>Meningkatkan transparansi publik terhadap posisi dan fungsi jabatan.</li>
              </ul>
            </p>
            <a href="{{ url('jabatan') }}">
              Lihat Struktur Jabatan
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

@endsection