@extends('layouts.admin.app')

@section('title', 'Tambah Warga Baru')

@section('content')

    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <h1 class="h4">Tambah Warga Baru</h1>
            <div>
                <a href="{{ route('warga.crud.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

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

                    <form action="{{ route('warga.crud.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12"> 
                                
                                {{-- 1. NIK --}}
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" name="nik" id="nik" 
                                        class="form-control @error('nik') is-invalid @enderror" 
                                        value="{{ old('nik') }}" required maxlength="16"
                                        placeholder="Masukkan 16 digit NIK">
                                    @error('nik') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                                
                                {{-- 2. Nama Lengkap --}}
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" 
                                        class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                        value="{{ old('nama_lengkap') }}" required>
                                    @error('nama_lengkap') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 3. Tanggal Lahir --}}
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                        value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 4. Jenis Kelamin --}}
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" 
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 5. Status Perkawinan --}}
                                <div class="mb-3">
                                    <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                    <select name="status_perkawinan" id="status_perkawinan" 
                                        class="form-select @error('status_perkawinan') is-invalid @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                    </select>
                                    @error('status_perkawinan') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- 6. Alamat --}}
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" id="alamat" 
                                        class="form-control @error('alamat') is-invalid @enderror" 
                                        rows="3" required
                                        placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>


                                {{-- Tombol Aksi --}}
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-save me-1"></i> Simpan Warga
                                    </button>
                                    <a href="{{ route('warga.crud.index') }}" class="btn btn-outline-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection