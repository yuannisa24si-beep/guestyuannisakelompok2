@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('hero_slider')
@endsection

@section('content')

  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Profil Saya
        </h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="detail-box" style="padding: 30px; border: 1px solid #ccc; border-radius: 10px;">
            @auth
                <h4>Selamat Datang, **{{ Auth::user()->nama }}**!</h4>
                <p>Ini adalah halaman profil Anda. Anda berhasil login dengan data Warga.</p>
                <hr>
                <dl class="row">
                    <dt class="col-sm-3">NIK:</dt>
                    <dd class="col-sm-9">{{ Auth::user()->nik }}</dd>

                    <dt class="col-sm-3">Role:</dt>
                    <dd class="col-sm-9"><span class="badge badge-info">{{ Auth::user()->role }}</span></dd>
                    
                    <dt class="col-sm-3">Telepon:</dt>
                    <dd class="col-sm-9">{{ Auth::user()->telepon ?? '-' }}</dd>

                    <dt class="col-sm-3">Alamat:</dt>
                    <dd class="col-sm-9">{{ Auth::user()->alamat ?? '-' }}</dd>
                </dl>
                
                {{-- 💡 Tombol Logout --}}
                <div class="mt-4">
                    <a href="{{ route('auth.logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-danger">
                        <i class="fa fa-sign-out"></i> Keluar (Logout)
                    </a>
                    
                    {{-- Form tersembunyi untuk POST logout request --}}
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

            @else
                <p>Anda belum login. Silahkan <a href="{{ route('auth.index') }}">Login</a>.</p>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection