{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Feane - Book A Table')

{{-- Area Head Extra: Menambahkan class 'sub_page' ke tag body.
     Class ini penting untuk styling halaman non-beranda. --}}
@section('head_extra')
<script>
  // Script untuk menambahkan class 'sub_page' ke body
  document.addEventListener('DOMContentLoaded', function() {
      document.body.classList.add('sub_page');
  });
</script>
@endsection

{{-- Karena ini halaman sub-page, kita mengosongkan hero_slider.
     Styling yang dilakukan oleh class "sub_page" di body akan mengatur ulang hero_area agar hanya menampilkan header. --}}
@section('hero_slider')
    {{-- Kosongkan Hero Slider untuk Sub Page --}}
@endsection


{{-- Section untuk konten utama halaman (Book Section) --}}
@section('content')

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Book A Table
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="">
              <div>
                <input type="text" class="form-control" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Phone Number" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Your Email" />
              </div>
              <div>
                <select class="form-control nice-select wide">
                  <option value="" disabled selected>
                    How many persons?
                  </option>
                  <option value="">
                    2
                  </option>
                  <option value="">
                    3
                  </option>
                  <option value="">
                    4
                  </option>
                  <option value="">
                    5
                  </option>
                </select>
              </div>
              <div>
                <input type="date" class="form-control">
              </div>
              <div class="btn_box">
                <button>
                  Book Now
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

{{-- @section('script_extra') --}}
{{-- Karena halaman ini menggunakan peta Google Maps (yang di-load di app.blade.php), kita tidak perlu menambahkan script khusus,
     kecuali ada inisialisasi peta yang rumit yang memerlukan skrip tambahan di sini. --}}
{{-- @endsection --}}