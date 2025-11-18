{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Daftar Jabatan Lembaga')

{{-- Area Head Extra: Menambahkan class 'sub_page' ke tag body dan style kustom. --}}
@section('head_extra')
<script>
  // Script untuk menambahkan class 'sub_page' ke body
  document.addEventListener('DOMContentLoaded', function() {
      document.body.classList.add('sub_page');
  });
</script>
<style>
  .filters_menu { display: none; } /* Nonaktifkan filter sementara karena menggunakan data dinamis */
  .jabatan-box {
    background: #222831;
    color: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    min-height: 220px;
  }
  .jabatan-title {
    font-weight: 700;
    font-size: 1.5rem;
    color: #ffbe2b;
  }
  .jabatan-box p {
    color: #bbb;
    margin-bottom: 10px;
    font-size: 0.95rem;
  }
  .jabatan-box .options h6 {
    color: #fff;
    font-weight: 600;
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

      {{-- Menampilkan pesan jika tidak ada data --}}
      @if ($jabatans->isEmpty())
          <div class="alert alert-warning text-center mt-5">
              Data jabatan belum tersedia. Silakan tambahkan data melalui halaman Admin.
          </div>
      @else
      
      <div class="filters-content">
        <div class="row grid">
          
          {{-- LOOPING DATA JABATAN DARI CONTROLLER ($jabatans) --}}
          @foreach ($jabatans as $jabatan)
            <div class="col-sm-6 col-lg-4 all level{{ $jabatan->level }}">
              <div class="jabatan-box">
                <div class="detail-box">
                  <p class="jabatan-title">{{ $jabatan->nama_jabatan }}</p>
                  <p class="small text-warning mb-2">Lembaga: {{ $jabatan->lembaga->nama_lembaga ?? 'Tidak Diketahui' }}</p>
                  <p>
                    {{ $jabatan->deskripsi }}
                  </p>
                  <div class="options">
                    <h6>Level: {{ $jabatan->level }}</h6>
                    <p class="text-secondary small">ID Jabatan: {{ $jabatan->jabatan_id }}</p>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
      @endif
      
      <div class="btn-box mt-5">
        <a href="{{ url('kontak') }}">
          Minta Akses Data Penuh
        </a>
      </div>
    </div>
  </section>

@endsection