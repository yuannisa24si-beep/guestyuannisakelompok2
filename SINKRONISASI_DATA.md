# Sinkronisasi Data Admin - Guest Portal

## Cara Kerja Sinkronisasi

Portal Guest dan Admin menggunakan **database yang sama** (`yuannisa-2sie_laravel`), sehingga data tersinkronisasi secara **real-time** dan **otomatis**.

### Alur Data

```
Admin Input Data → Database MySQL → Guest Portal Menampilkan
```

### Tabel yang Tersinkronisasi

1. **lembaga** - Data lembaga desa
2. **jabatan_lembaga** - Data jabatan
3. **warga** - Data warga
4. **perangkat_desa** - Data perangkat desa
5. **rw** - Data RW
6. **rt** - Data RT
7. **anggota_lembaga** - Data anggota lembaga

### Contoh Sinkronisasi

#### Ketika Admin Menambah Data Warga:
1. Admin login ke sistem admin (`aliyasie.sunghoon.baby/dashboard`)
2. Admin menambah data warga baru
3. Data tersimpan ke tabel `warga` di database
4. **Guest portal langsung menampilkan data baru** tanpa perlu refresh manual
5. Cukup refresh halaman guest portal untuk melihat data terbaru

#### Ketika Admin Mengubah Data:
1. Admin mengubah data lembaga
2. Data di database ter-update
3. Guest portal otomatis menampilkan data yang sudah diubah

#### Ketika Admin Menghapus Data:
1. Admin menghapus data jabatan
2. Data terhapus dari database
3. Guest portal tidak lagi menampilkan data yang dihapus

## Tidak Ada Data Manual

✅ **SEMUA DATA DARI DATABASE**
- Guest portal **TIDAK** menggunakan data hardcoded/manual
- Semua data diambil langsung dari database menggunakan query
- Jika database kosong, guest portal akan menampilkan "Tidak ada data"

❌ **TIDAK ADA DATA STATIS**
- Tidak ada data yang diketik manual di code
- Tidak ada data fallback statis
- Semua data dinamis dari database

## Cara Menguji Sinkronisasi

### Test 1: Tambah Data dari Admin
1. Login ke admin panel
2. Tambah data warga baru
3. Buka guest portal → Data Warga
4. Data baru akan muncul

### Test 2: Edit Data dari Admin
1. Login ke admin panel
2. Edit nama lembaga
3. Buka guest portal → Lembaga Desa
4. Nama lembaga sudah berubah

### Test 3: Hapus Data dari Admin
1. Login ke admin panel
2. Hapus data perangkat desa
3. Buka guest portal → Perangkat Desa
4. Data sudah tidak ada

## Konfigurasi Database

Kedua sistem (Admin & Guest) menggunakan konfigurasi database yang sama di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yuannisa-2sie_laravel
DB_USERNAME=root
DB_PASSWORD=
```

## Query Database di Guest Portal

Contoh query yang digunakan di guest portal:

```php
// Mengambil data lembaga
$lembagas = DB::table('lembaga')
    ->orderBy('created_at', 'desc')
    ->get();

// Mengambil data jabatan dengan join
$jabatans = DB::table('jabatan_lembaga')
    ->leftJoin('lembaga', 'jabatan_lembaga.lembaga_id', '=', 'lembaga.lembaga_id')
    ->select('jabatan_lembaga.*', 'lembaga.nama_lembaga')
    ->orderBy('jabatan_lembaga.created_at', 'desc')
    ->get();
```

## Timestamp Sinkronisasi

Dashboard guest menampilkan timestamp terakhir data diperbarui:
- Mengambil `updated_at` terbaru dari semua tabel
- Menampilkan waktu terakhir admin mengubah data
- Format: "Terakhir diperbarui: 20 Des 2025 17:00"

## Kesimpulan

✅ Data tersinkronisasi **OTOMATIS**
✅ Tidak perlu konfigurasi tambahan
✅ Tidak ada data manual/hardcoded
✅ Real-time update dari admin ke guest
✅ Menggunakan database yang sama
✅ Query langsung ke database MySQL
