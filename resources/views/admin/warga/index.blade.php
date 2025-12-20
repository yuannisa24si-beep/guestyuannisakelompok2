@extends('layouts.admin.app')

@section('title', 'Daftar Warga')

@section('content')

    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            {{-- 💡 PERBAIKAN FATAL: Mengganti $warga->nama_lengkap dengan judul statis --}}
            <h1 class="h4">Daftar Data Warga</h1>
            <div>
                <a href="{{ route('warga.crud.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Warga Baru
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('warga.crud.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" 
                   placeholder="Cari Nama, NIK, atau Alamat..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
            @if ($search)
                <a href="{{ route('warga.crud.index') }}" class="btn btn-outline-danger">Reset</a>
            @endif
        </div>
    </form>

    {{-- Tampilan Card / Grid --}}
    <div class="row">
        @forelse ($wargas as $warga)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $warga->nama_lengkap }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">NIK: {{ $warga->nik }}</h6>
                        
                        <div class="mt-3 small">
                            <p class="mb-1"><strong>Status:</strong> {{ $warga->status_perkawinan }} ({{ $warga->jenis_kelamin }})</p>
                            <p class="mb-1"><strong>Lahir:</strong> {{ $warga->tanggal_lahir }}</p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ Str::limit($warga->alamat, 80) }}</p>
                        </div>
                        <hr>
                        
                        {{-- Tombol Aksi --}}
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('warga.crud.edit', $warga->warga_id) }}" 
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('warga.crud.destroy', $warga->warga_id) }}" method="POST" 
                                  onsubmit="return confirm('Hapus Data Warga ini?')" 
                                  class="d-inline flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Data warga belum tersedia.
                </div>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $wargas->links() }}
    </div>

@endsection