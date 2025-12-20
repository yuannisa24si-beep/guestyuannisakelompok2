@extends('layouts.admin.app')

@section('title', 'Daftar Jabatan')

@section('content')

    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <h1 class="h4">Daftar Data Jabatan</h1>
            <div>
                <a href="{{ route('jabatan.crud.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Jabatan Baru
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('jabatan.crud.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" 
                   placeholder="Cari Nama Jabatan atau Deskripsi..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
            @if ($search)
                <a href="{{ route('jabatan.crud.index') }}" class="btn btn-outline-danger">Reset</a>
            @endif
        </div>
    </form>

    {{-- Tampilan Card / Grid --}}
    <div class="row">
        @forelse ($jabatans as $jabatan)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-primary">{{ $jabatan->nama_jabatan }}</h5>
                            <span class="badge bg-secondary">Level {{ $jabatan->level }}</span>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Lembaga: {{ $jabatan->lembaga->nama_lembaga ?? 'Tidak Terkait' }}
                        </h6>
                        <p class="card-text small mt-3">
                            {{ Str::limit($jabatan->deskripsi, 100) }}
                        </p>
                        <hr>
                        
                        {{-- Tombol Aksi (Edit & Hapus) --}}
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('jabatan.crud.edit', $jabatan->jabatan_id) }}" 
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('jabatan.crud.destroy', $jabatan->jabatan_id) }}" method="POST" 
                                  onsubmit="return confirm('Hapus Jabatan ini?')" 
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
                    Data jabatan belum tersedia.
                </div>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $jabatans->links() }}
    </div>

@endsection