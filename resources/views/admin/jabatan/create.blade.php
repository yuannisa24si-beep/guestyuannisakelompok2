@extends('layouts.admin.app')

@section('title', 'Tambah Jabatan Baru')

@section('content')

    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <h1 class="h4">Tambah Jabatan Baru</h1>
            <div>
                <a href="{{ route('jabatan.crud.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    {{-- Menampilkan Error Validasi (HARUS ADA DI LUAR FORM AGAR TERLIHAT) --}}
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

                    {{-- 💡 PERBAIKAN KRITIS: Tag <form> harus membungkus SEMUA input --}}
                    <form action="{{ route('jabatan.crud.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12"> 
                                
                                {{-- 1. LEMBAGA ID (FIXED DROPDOWN STRUCTURE) --}}
                                <div class="mb-3">
                                    <label for="lembaga_id" class="form-label">Lembaga</label>
                                    
                                    {{-- 💡 Struktur <select> yang benar --}}
                                    <select name="lembaga_id" id="lembaga_id" 
                                        class="form-select @error('lembaga_id') is-invalid @enderror" required>
                                        
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
                                {{-- END LEMBAGA --}}

                                {{-- 2. Nama Jabatan --}}
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan" id="nama_jabatan" 
                                        class="form-control @error('nama_jabatan') is-invalid @enderror" 
                                        value="{{ old('nama_jabatan') }}" required 
                                        placeholder="Misalnya: Wakil Kepala Desa">
                                    @error('nama_jabatan') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 3. Level --}}
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level Jabatan</label>
                                    <input type="number" name="level" id="level" 
                                        class="form-control @error('level') is-invalid @enderror" 
                                        value="{{ old('level') }}" required min="1" max="10"
                                        placeholder="Contoh: 1 (Level Puncak)">
                                    
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

                                {{-- Tombol Aksi (FIXED: Tombol Simpan HARUS type="submit") --}}
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-save me-1"></i> Simpan Jabatan
                                    </button>
                                    
                                    <a href="{{ route('jabatan.crud.index') }}" class="btn btn-outline-secondary">Batal</a>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- 💡 FORM DITUTUP DI SINI --}}
                </div>
            </div>
        </div>
    </div>

@endsection