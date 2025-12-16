<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk layout yang rapi dan ditengahkan */
        body { background-color: #f8f9fa; }
        .login-container { 
            max-width: 400px; 
            margin-top: 100px; /* Jarak dari atas */
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            background-color: #ffffff; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container mx-auto">
            <h2 class="text-center mb-4">Login Warga</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf 
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Belum punya akun? 
                <a href="{{ route('auth.register.form') }}">Daftar di sini</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>