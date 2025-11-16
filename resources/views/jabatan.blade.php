{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Daftar Jabatan Lembaga')

{{-- Area Head Extra: Menambahkan class 'sub_page' ke tag body. --}}
@section('head_extra')
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.body.classList.add('sub_page');
  });
</script>
<style>
  /* Menghapus atau menyesuaikan style .filters_menu jika tidak digunakan untuk filter */
  .filters_menu { display: none; } 
  .jabatan-box {
    background: #222831;
    color: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  }
  .jabatan-title {
    font-weight: 700;
    font-size: 1.5rem;
    color: #ffbe2b;
  }
</style>
@endsection

{{-- Mengosongkan hero_slider karena ini sub-page --}}
@section('hero_slider')
    {{-- Kosongkan Hero Slider untuk Sub Page --}}
@endsection


{{-- Section untuk konten utama halaman (Daftar Jabatan) --}}
@section('content')

  <!-- Jabatan section (Menggantikan Food section) -->
  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Struktur Jabatan Lembaga
        </h2>
      </div>

      {{-- Konten Jabatan dalam format Grid --}}
      <div class="filters-content">
        <div class="row grid">
          
          {{-- Contoh Data Jabatan 1: jabatan_id (PK), lembaga_id (FK), nama_jabatan, level --}}
          <div class="col-sm-6 col-lg-4 all jabatan">
            <div class="jabatan-box">
              <div class="detail-box">
                <p class="jabatan-title">Kepala Lembaga</p>
                <p>
                  Jabatan tertinggi (Level 1) dalam struktur organisasi. Bertanggung jawab atas keseluruhan operasional dan kebijakan strategis Lembaga.
                </p>
                <div class="options">
                  <h6>Level: 1</h6>
                  <p class="text-secondary small">ID Jabatan: JBT001</p>
                </div>
              </div>
            </div>
          </div>
          
          {{-- Contoh Data Jabatan 2 --}}
          <div class="col-sm-6 col-lg-4 all jabatan">
            <div class="jabatan-box">
              <div class="detail-box">
                <p class="jabatan-title">Direktur Operasional</p>
                <p>
                  Mengawasi kegiatan operasional harian dan memastikan efisiensi kerja. Bertanggung jawab langsung kepada Kepala Lembaga.
                </p>
                <div class="options">
                  <h6>Level: 2</h6>
                  <p class="text-secondary small">ID Jabatan: JBT002</p>
                </div>
              </div>
            </div>
          </div>
          
          {{-- Contoh Data Jabatan 3 --}}
          <div class="col-sm-6 col-lg-4 all jabatan">
            <div class="jabatan-box">
              <div class="detail-box">
                <p class="jabatan-title">Manajer Data & TI</p>
                <p>
                  Mengelola basis data, infrastruktur teknologi, dan sistem informasi Lembaga. Posisi kunci di era digital.
                </p>
                <div class="options">
                  <h6>Level: 3</h6>
                  <p class="text-secondary small">ID Jabatan: JBT003</p>
                </div>
              </div>
            </div>
          </div>

          {{-- Anda bisa menambahkan lebih banyak data di sini --}}

        </div>
      </div>
      <div class="btn-box">
        <a href="{{ url('kontak') }}">
          Lihat Struktur Penuh
        </a>
      </div>
    </div>
  </section>

@endsection