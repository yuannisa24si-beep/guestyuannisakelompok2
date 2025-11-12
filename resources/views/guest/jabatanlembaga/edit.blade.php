@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Jabatan Lembaga</h2>

    <form action="{{ route('jabatanlembaga.update', $jabatanLembaga->jabatan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" class="form-control" value="{{ $jabatanLembaga->nama_jabatan }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
            <input type="text" name="level" class="form-control" value="{{ $jabatanLembaga->level }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jabatanlembaga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
