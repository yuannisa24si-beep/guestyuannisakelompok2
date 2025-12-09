{{-- Memperluas (extends) master layout app.blade.php --}}
@extends('layouts.app')

{{-- Menentukan judul halaman --}}
@section('title', 'Login Aplikasi')

{{-- Menghilangkan Slider untuk halaman Login --}}
@section('hero_slider')
@endsection

{{-- Section untuk konten utama halaman --}}
@section('content')

  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Login Data Warga
        </h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="form_container">
           <form action="{{ route('auth.login') }}" method="POST"> 
    @csrf
    </form>
    <div class="btn_box mt-4">
        <button type="submit">
            Masuk (Login)
        </button>
    </div>
</form>
                @csrf
                
                {{-- Tampilkan pesan error jika ada --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
              <div>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required value="{{ old('nama') }}" />
                @error('nama')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div>
                <input type="text" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan (NIK)" required value="{{ old('nik') }}" />
                @error('nik')<span class="text-danger">{{ $message }}</span>@enderror
              </div>

              <div class="btn_box mt-4">
                <button type="submit">
                  Masuk (Login)
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection