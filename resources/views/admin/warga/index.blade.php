<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style> .container { margin-top: 50px; } </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Daftar Data Warga</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">
            + Tambah Warga Baru
        </a>

        <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Cari berdasarkan Nama, NIK, atau Email..." 
                       value="{{ $search ?? '' }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if ($search)
                    <a href="{{ route('warga.index') }}" class="btn btn-outline-danger">
                        Reset
                    </a>
                @endif
            </div>
        </form>
                    
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th> <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Role</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wargas as $warga)
                    <tr>
                        <td>{{ $warga->warga_id }}</td>
                        <td>{{ $warga->nik }}</td>
                        <td>{{ $warga->nama }}</td>
                        <td>{{ $warga->email }}</td> <td>{{ Str::limit($warga->alamat, 50) }}</td>
                        <td>{{ $warga->telepon }}</td>
                        <td>{{ $warga->role }}</td>
                        <td>
                            <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                            
                            <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data warga ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data warga.</td> </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $wargas->links() }}
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>