<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .register-container { max-width: 600px; margin-top: 50px; margin-bottom: 50px; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); background-color: #ffffff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container mx-auto">
            <h2 class="text-center mb-4">Daftar Akun Warga Baru</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.register.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK (16 Digit)</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik') }}" maxlength="16" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon') }}" maxlength="15">
                </div>
                
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-success">Daftar Sekarang</button>
                </div>
            </form>

            <p class="text-center mt-3">
                Sudah punya akun? 
                <a href="{{ route('auth.index') }}">Login di sini</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>