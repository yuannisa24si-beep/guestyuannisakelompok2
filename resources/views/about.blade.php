{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Feane - About Us')

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


{{-- Section untuk konten utama halaman (About Section) --}}
@section('content')

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            {{-- PATH DIPERBARUI: public/assets/images/about-img.png --}}
            <img src="{{ asset('assets/images/gambar2.jpg') }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                We Are Feane
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour, or randomised words which don't look even slightly believable. If you
              are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
              the middle of text. All
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

@endsection

{{-- @section('script_extra') --}}
{{-- Di sini Anda bisa menambahkan script yang hanya dibutuhkan oleh halaman ini (jika ada) --}}
{{-- @endsection --}}