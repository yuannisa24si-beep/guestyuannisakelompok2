<!DOCTYPE html>
<html>
<head>
    <title>Login Warga</title>
</head>
<body>

<h2>Login Warga</h2>

@if(session('error'))
<p style="color:red;">{{ session('error') }}</p>
@endif

<form action="{{ route('warga.login.post') }}" method="POST">
    @csrf
    <label>NIK:</label><br>
    <input type="text" name="nik" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>