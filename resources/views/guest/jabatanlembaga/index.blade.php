@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Jabatan Lembaga</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('jabatanlembaga.create') }}" class="btn btn-primary mb-3">+ Tambah Jabatan</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Jabatan</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jabatanLembagas as $item)
                <tr>
                    <td>{{ $item->jabatan_id }}</td>
                    <td>{{ $item->nama_jabatan }}</td>
                    <td>{{ $item->level }}</td>
                    <td>
                        <a href="{{ route('jabatanlembaga.edit', $item->jabatan_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jabatanlembaga.destroy', $item->jabatan_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
