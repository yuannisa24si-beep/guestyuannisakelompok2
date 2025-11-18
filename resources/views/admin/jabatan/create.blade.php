@extends('layouts.admin.app')

@section('content')

    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/dashboard') }}">
                        {{-- Ikon Home --}}
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('jabatan.index') }}">Jabatan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Jabatan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Tambah Jabatan</h1>
                <p class="mb-0">Formulir untuk menambahkan data jabatan baru.</p>
            </div>
            <div>
                <a href="{{ route('jabatan.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h4 class="alert-heading">Terdapat Kesalahan!</h4>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORMULIR TAMBAH JABATAN --}}
                    <form action="{{ route('jabatan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8 col-sm-12">

                                {{-- 1. Lembaga ID (Foreign Key) --}}
                                <div class="mb-3">
                                    <label for="lembaga_id" class="form-label">Lembaga **(Wajib)**</label>
                                    {{-- $lembagaList harus di-pass dari JabatanController@create --}}
                                    <select name="lembaga_id" id="lembaga_id" class="form-select @error('lembaga_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Lembaga --</option>
                                        @foreach ($lembagaList as $lembaga)
                                            <option value="{{ $lembaga->lembaga_id }}" 
                                                {{ old('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                                {{ $lembaga->nama_lembaga }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lembaga_id') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 2. Nama Jabatan --}}
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label">Nama Jabatan **(Wajib)**</label>
                                    <input type="text" name="nama_jabatan" id="nama_jabatan" 
                                        class="form-control @error('nama_jabatan') is-invalid @enderror" 
                                        value="{{ old('nama_jabatan') }}" required 
                                        placeholder="Misalnya: Manajer Pemasaran">
                                    @error('nama_jabatan') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 3. Level --}}
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level Jabatan **(Wajib)**</label>
                                    <input type="number" name="level" id="level" 
                                        class="form-control @error('level') is-invalid @enderror" 
                                        value="{{ old('level') }}" required min="1" max="10"
                                        placeholder="1">
                                    <div class="form-text">Angka 1 untuk level tertinggi (Puncak), angka yang lebih besar untuk level di bawahnya.</div>
                                    @error('level') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 4. Deskripsi --}}
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Jabatan</label>
                                    <textarea name="deskripsi" id="deskripsi" 
                                        class="form-control @error('deskripsi') is-invalid @enderror" 
                                        rows="4" 
                                        placeholder="Jelaskan ringkasan tugas dan tanggung jawab...">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-save me-1"></i> Simpan Jabatan
                                    </button>
                                    <a href="{{ route('jabatan.index') }}" class="btn btn-outline-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection