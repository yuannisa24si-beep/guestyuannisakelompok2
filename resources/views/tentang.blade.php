{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Kontak dan Permintaan Data')

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


{{-- Section untuk konten utama halaman (Kontak Section) --}}
@section('content')

  <!-- book section (Diubah menjadi Kontak) -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Hubungi Kami
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
                <textarea class="form-control" rows="3" placeholder="Jelaskan kebutuhan/pesan Anda..."></textarea>
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
      <div class="mt-5 text-center">
        <p class="text-muted">Atau kunjungi kantor kami pada jam pelayanan: Senin-Jumat, 08.00 - 16.00 WIB.</p>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection