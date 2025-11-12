@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Jabatan Lembaga</h2>

    <form action="{{ route('jabatanlembaga.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
            <input type="text" name="level" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('jabatanlembaga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
