<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jabatan: {{ $jabatan->nama_jabatan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 50px; max-width: 800px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Edit Jabatan: {{ $jabatan->nama_jabatan }}</h1>

        <!-- Tombol Kembali -->
        <a href="{{ route('jabatan.crud.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Jabatan</a>

        <!-- Form Edit Data Jabatan -->
        <form action="{{ route('jabatan.crud.update', $jabatan->jabatan_id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Spoofing method ke PUT untuk UPDATE --}}
            
            <!-- Daftar Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="lembaga_id" class="form-label">Lembaga (FK)</label>
                <select name="lembaga_id" id="lembaga_id" class="form-select @error('lembaga_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Lembaga --</option>
                    {{-- $lembagaList di-passing dari JabatanController@edit --}}
                    @foreach ($lembagaList as $lembaga)
                        <option value="{{ $lembaga->lembaga_id }}" 
                            {{ (old('lembaga_id') ?? $jabatan->lembaga_id) == $lembaga->lembaga_id ? 'selected' : '' }}>
                            {{ $lembaga->nama_lembaga }}
                        </option>
                    @endforeach
                </select>
                @error('lembaga_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control @error('nama_jabatan') is-invalid @enderror" value="{{ old('nama_jabatan') ?? $jabatan->nama_jabatan }}" required>
                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Level Jabatan</label>
                <input type="number" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level') ?? $jabatan->level }}" required min="1">
                <div class="form-text">Contoh: 1 (Puncak), 2 (Direktur), 3 (Manajer).</div>
                @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Jabatan</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi') ?? $jabatan->deskripsi }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Perbarui Jabatan</button>
        </form>
        
        <div class="mt-4">
            <a href="{{ route('jabatan.crud.index') }}" class="btn btn-link">Batalkan</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>