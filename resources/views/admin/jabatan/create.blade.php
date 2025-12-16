@extends('layouts.admin.app')

@section('content')

    {{-- ... (Bagian Header dan Breadcrumb) ... --}}
    
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORMULIR TAMBAH JABATAN --}}
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12"> 
                                
                                {{-- 1. LEMBAGA ID  --}}
                                <div class="mb-3">
                                    <label for="lembaga_id" class="form-label">Lembaga</label>
                                   
     
                                        {{-- $lembagaList dikirim dari JabatanController@create --}}
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


                                {{-- 2. Nama Jabatan (Dropdown/Custom Input) --}}
                                {{-- Gunakan kembali input yang Anda inginkan (saya pakai input teks)--}}
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan" id="nama_jabatan" 
                                        class="form-control @error('nama_jabatan') is-invalid @enderror" 
                                        value="{{ old('nama_jabatan') }}" required 
                                        placeholder="Manajer Pemasaran">
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

                                {{-- Tombol Aksi --}}
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success me-2">
                                        <a href="{{ route('jabatan.index') }}" class="btn btn-outline-secondary">Simpan</a>
                                    </button>

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