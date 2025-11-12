{{-- resources/views/guest/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Informasi Desa</title>

    {{-- Hubungkan file CSS dari public --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e3a8a 100%);
            color: white;
            padding: 30px 0;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logo i {
            font-size: 2.5rem;
            color: #ffd700;
        }
        .logo-text h1 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        .logo-text p {
            font-size: 1rem;
            opacity: 0.9;
        }
        .search-box {
            display: flex;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            padding: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .search-box input {
            border: none;
            padding: 10px 15px;
            width: 250px;
            outline: none;
        }
        .search-box button {
            background: #2c5aa0;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .search-box button:hover {
            background: #1e3a8a;
        }
        .dashboard-title {
            text-align: center;
            margin: 30px 0;
            color: #2c3e50;
        }
        .dashboard-title h2 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }
        .dashboard-title p {
            font-size: 1.1rem;
            color: #7f8c8d;
            max-width: 700px;
            margin: 0 auto;
        }
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        .card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        .card-header {
            background: #3498db;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .card-header i {
            font-size: 1.8rem;
        }
        .card-body {
            padding: 20px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #2c3e50;
        }
        .info-value {
            color: #7f8c8d;
        }
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        }
        .table-header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-primary {
            background: #e1f0ff;
            color: #3498db;
        }
        .badge-success {
            background: #e1f7e7;
            color: #27ae60;
        }
        footer {
            text-align: center;
            padding: 30px 0;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-landmark"></i>
                    <div class="logo-text">
                        <h1>Desa Maju Jaya</h1>
                        <p>Sistem Informasi Jabatan & Lembaga Desa</p>
                    </div>
                </div>
                <div class="search-box">
                    <input type="text" placeholder="Cari jabatan atau lembaga...">
                    <button><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="dashboard-title">
            <h2>Struktur Jabatan dan Lembaga Desa</h2>
            <p>Informasi mengenai jabatan dan lembaga aktif di Desa Maju Jaya</p>
        </div>

        {{-- Kartu Statistik --}}
        <div class="cards-container">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-tie"></i>
                    <h3>Data Jabatan</h3>
                </div>
                <div class="card-body">
                    <div class="info-item"><span class="info-label">Total Jabatan</span> <span class="info-value">8 Jabatan</span></div>
                    <div class="info-item"><span class="info-label">Kepala Jabatan</span> <span class="info-value">Ahmad Sudrajat</span></div>
                    <div class="info-item"><span class="info-label">Periode</span> <span class="info-value">2021 - 2026</span></div>
                    <div class="info-item"><span class="info-label">Status</span> <span class="info-value badge badge-success">Aktif</span></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-building"></i>
                    <h3>Data Lembaga</h3>
                </div>
                <div class="card-body">
                    <div class="info-item"><span class="info-label">Jumlah Lembaga</span> <span class="info-value">5</span></div>
                    <div class="info-item"><span class="info-label">Lembaga Aktif</span> <span class="info-value">4</span></div>
                    <div class="info-item"><span class="info-label">Terbaru</span> <span class="info-value">Karang Taruna</span></div>
                    <div class="info-item"><span class="info-label">Update</span> <span class="info-value">10 April 2023</span></div>
                </div>
            </div>
        </div>

        {{-- Tabel Jabatan --}}
        <div class="table-container">
            <div class="table-header">
                <i class="fas fa-table"></i>
                <h3>Daftar Jabatan Desa</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Kontak</th>
                        <th>Periode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ahmad Sudrajat</td>
                        <td>Kepala Desa</td>
                        <td>0812-3456-7890</td>
                        <td>2021-2026</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>Siti Rahayu</td>
                        <td>Sekretaris Desa</td>
                        <td>0813-4567-8901</td>
                        <td>2021-2026</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>Budi Santoso</td>
                        <td>Kaur Keuangan</td>
                        <td>0814-5678-9012</td>
                        <td>2021-2026</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Tabel Lembaga --}}
        <div class="table-container">
            <div class="table-header">
                <i class="fas fa-list-alt"></i>
                <h3>Daftar Lembaga Desa</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Lembaga</th>
                        <th>Deskripsi</th>
                        <th>Ketua</th>
                        <th>Kontak</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>BPD</td>
                        <td>Lembaga legislatif desa</td>
                        <td>Drs. Sutrisno</td>
                        <td>0812-9876-5432</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>PKK</td>
                        <td>Lembaga pemberdayaan perempuan desa</td>
                        <td>Ibu Susanti</td>
                        <td>0813-8765-4321</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>Karang Taruna</td>
                        <td>Organisasi kepemudaan desa</td>
                        <td>Andi Wijaya</td>
                        <td>0814-7654-3210</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Sistem Informasi Jabatan & Lembaga Desa Maju Jaya. Semua hak dilindungi.</p>
            <p>Data diperbarui terakhir: 12 November 2025</p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Fungsi pencarian sederhana
        document.querySelector('.search-box button').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-box input').value.toLowerCase();
            const tables = document.querySelectorAll('table');

            tables.forEach(table => {
                const rows = table.querySelectorAll('tbody tr');
                let found = false;

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                        found = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada hasil
                const noResults = table.querySelector('.no-results');
                if (!found) {
                    if (!noResults) {
                        const messageRow = document.createElement('tr');
                        messageRow.className = 'no-results';
                        messageRow.innerHTML = `<td colspan="5" style="text-align: center; padding: 20px; color: #7f8c8d;">Tidak ada hasil yang ditemukan</td>`;
                        table.querySelector('tbody').appendChild(messageRow);
                    }
                } else if (noResults) {
                    noResults.remove();
                }
            });
        });

        // Tambahkan event listener untuk tombol enter pada input pencarian
        document.querySelector('.search-box input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.search-box button').click();
            }
        });
    </script>
</body>
</html>
