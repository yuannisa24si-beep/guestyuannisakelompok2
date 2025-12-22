<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;

class ApiSyncController extends Controller
{
    private $baseUrl = 'http://aliyasie.sunghoon.baby';
    
    public function getJabatan()
    {
        try {
            // Coba ambil data dari API eksternal terlebih dahulu
            $jabatans = Cache::remember('external_jabatan', 300, function () {
                return $this->fetchJabatanFromExternal();
            });
            
            return view('guest.jabatan', compact('jabatans'));
        } catch (Exception $e) {
            // Log error untuk debugging
            \Log::error('Failed to fetch jabatan data: ' . $e->getMessage());
            
            try {
                // Coba ambil dari database lokal sebagai fallback
                $jabatans = $this->getJabatanFromDatabase();
                if ($jabatans->isNotEmpty()) {
                    return view('guest.jabatan', compact('jabatans'));
                }
            } catch (Exception $dbError) {
                \Log::error('Failed to fetch from local database: ' . $dbError->getMessage());
            }
            
            // Gunakan data fallback statis
            $jabatans = $this->getFallbackJabatan();
            return view('guest.jabatan', compact('jabatans'));
        }
    }
    
    public function getLembagaDesa()
    {
        try {
            $lembagas = Cache::remember('external_lembaga', 300, function () {
                return $this->fetchLembagaFromExternal();
            });
            
            return view('guest.lembaga-desa', compact('lembagas'));
        } catch (Exception $e) {
            \Log::error('Failed to fetch lembaga data: ' . $e->getMessage());
            
            try {
                // Coba ambil dari database lokal
                $lembagas = $this->getLembagaFromDatabase();
                if ($lembagas->isNotEmpty()) {
                    return view('guest.lembaga-desa', compact('lembagas'));
                }
            } catch (Exception $dbError) {
                \Log::error('Failed to fetch lembaga from local database: ' . $dbError->getMessage());
            }
            
            $lembagas = $this->getFallbackLembaga();
            return view('guest.lembaga-desa', compact('lembagas'));
        }
    }
    
    public function getWarga()
    {
        try {
            $wargas = Cache::remember('external_warga', 300, function () {
                return $this->fetchWargaFromExternal();
            });
            
            return view('guest.warga', compact('wargas'));
        } catch (Exception $e) {
            \Log::error('Failed to fetch warga data: ' . $e->getMessage());
            
            try {
                // Coba ambil dari database lokal
                $wargas = $this->getWargaFromDatabase();
                if ($wargas->isNotEmpty()) {
                    return view('guest.warga', compact('wargas'));
                }
            } catch (Exception $dbError) {
                \Log::error('Failed to fetch warga from local database: ' . $dbError->getMessage());
            }
            
            $wargas = $this->getFallbackWarga();
            return view('guest.warga', compact('wargas'));
        }
    }
    
    // Method untuk mengambil data dari database lokal
    private function getJabatanFromDatabase()
    {
        try {
            $jabatans = DB::table('jabatans')
                ->leftJoin('lembaga_desa', 'jabatans.lembaga_id', '=', 'lembaga_desa.lembaga_id')
                ->select('jabatans.*', 'lembaga_desa.nama_lembaga')
                ->get()
                ->map(function ($item) {
                    return (object)[
                        'id' => $item->id,
                        'lembaga_id' => $item->lembaga_id,
                        'nama_jabatan' => $item->nama_jabatan,
                        'level' => $item->level,
                        'nama_lembaga' => $item->nama_lembaga ?? 'Unknown',
                        'created_at' => $item->created_at
                    ];
                });
            
            return collect($jabatans);
        } catch (Exception $e) {
            throw new Exception('Database query failed: ' . $e->getMessage());
        }
    }
    
    private function getLembagaFromDatabase()
    {
        try {
            $lembagas = DB::table('lembaga_desa')->get();
            return collect($lembagas);
        } catch (Exception $e) {
            throw new Exception('Database query failed: ' . $e->getMessage());
        }
    }
    
    private function getWargaFromDatabase()
    {
        try {
            $wargas = DB::table('wargas')->get();
            return collect($wargas);
        } catch (Exception $e) {
            throw new Exception('Database query failed: ' . $e->getMessage());
        }
    }
    
    private function fetchJabatanFromExternal()
    {
        // Coba beberapa endpoint yang mungkin ada
        $endpoints = [
            '/api/jabatan',
            '/jabatan/api',
            '/jabatan.json',
            '/jabatan'
        ];
        
        foreach ($endpoints as $endpoint) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . $endpoint);
                
                if ($response->successful()) {
                    // Jika response adalah JSON
                    if ($response->header('content-type') && str_contains($response->header('content-type'), 'application/json')) {
                        $data = $response->json();
                        return $this->parseJabatanData($data);
                    }
                    
                    // Jika response adalah HTML, coba parse
                    $htmlContent = $response->body();
                    $parsedData = $this->parseJabatanFromHtml($htmlContent);
                    
                    if (!empty($parsedData)) {
                        return collect($parsedData);
                    }
                }
            } catch (Exception $e) {
                continue; // Coba endpoint berikutnya
            }
        }
        
        throw new Exception('No valid endpoint found');
    }
    
    private function parseJabatanFromHtml($html)
    {
        // Parsing sederhana untuk HTML
        $jabatans = [];
        
        // Contoh parsing menggunakan regex (sesuaikan dengan struktur HTML asli)
        if (preg_match_all('/<tr.*?>(.*?)<\/tr>/s', $html, $matches)) {
            foreach ($matches[1] as $index => $row) {
                if ($index === 0) continue; // Skip header
                
                if (preg_match_all('/<td.*?>(.*?)<\/td>/s', $row, $cells)) {
                    if (count($cells[1]) >= 3) {
                        $jabatans[] = (object)[
                            'id' => $index,
                            'nama_jabatan' => strip_tags($cells[1][0] ?? 'Unknown'),
                            'level' => strip_tags($cells[1][1] ?? 'Unknown'),
                            'nama_lembaga' => strip_tags($cells[1][2] ?? 'Unknown'),
                            'created_at' => now()->format('Y-m-d H:i:s')
                        ];
                    }
                }
            }
        }
        
        return $jabatans;
    }
    
    private function parseJabatanData($data)
    {
        // Jika data sudah dalam format array/collection
        if (is_array($data)) {
            return collect($data)->map(function ($item) {
                return (object)[
                    'id' => $item['id'] ?? rand(1, 1000),
                    'nama_jabatan' => $item['nama_jabatan'] ?? $item['name'] ?? 'Unknown',
                    'level' => $item['level'] ?? 'Unknown',
                    'nama_lembaga' => $item['nama_lembaga'] ?? $item['lembaga'] ?? 'Unknown',
                    'created_at' => $item['created_at'] ?? now()->format('Y-m-d H:i:s')
                ];
            });
        }
        
        return collect();
    }
    
    private function fetchLembagaFromExternal()
    {
        $endpoints = ['/api/lembaga', '/lembaga/api', '/lembaga.json', '/lembaga'];
        
        foreach ($endpoints as $endpoint) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . $endpoint);
                
                if ($response->successful()) {
                    if ($response->header('content-type') && str_contains($response->header('content-type'), 'application/json')) {
                        return collect($response->json());
                    }
                }
            } catch (Exception $e) {
                continue;
            }
        }
        
        throw new Exception('No valid lembaga endpoint found');
    }
    
    private function fetchWargaFromExternal()
    {
        $endpoints = ['/api/warga', '/warga/api', '/warga.json', '/warga'];
        
        foreach ($endpoints as $endpoint) {
            try {
                $response = Http::timeout(10)->get($this->baseUrl . $endpoint);
                
                if ($response->successful()) {
                    if ($response->header('content-type') && str_contains($response->header('content-type'), 'application/json')) {
                        return collect($response->json());
                    }
                }
            } catch (Exception $e) {
                continue;
            }
        }
        
        throw new Exception('No valid warga endpoint found');
    }
    
    private function getFallbackJabatan()
    {
        return collect([
            (object)[
                'id' => 1,
                'lembaga_id' => 15,
                'nama_jabatan' => 'Kepala Desa',
                'level' => 'Tinggi',
                'nama_lembaga' => 'Kelompok Informasi Masyarakat (KIM)',
                'created_at' => '2025-12-15 10:50:14'
            ],
            (object)[
                'id' => 2,
                'lembaga_id' => 11,
                'nama_jabatan' => 'Sekretaris Desa',
                'level' => 'Menengah',
                'nama_lembaga' => 'Tim Penggerak PKK Desa',
                'created_at' => '2025-12-15 10:50:14'
            ]
        ]);
    }
    
    private function getFallbackLembaga()
    {
        return collect([
            (object)[
                'lembaga_id' => 1,
                'nama_lembaga' => 'Badan Permusyawaratan Desa (BPD)',
                'deskripsi' => 'Lembaga yang menampung dan menyalurkan aspirasi masyarakat desa.',
                'kontak' => '081234567890',
                'created_at' => '2025-12-15 10:50:14'
            ]
        ]);
    }
    
    private function getFallbackWarga()
    {
        return collect([
            (object)[
                'warga_id' => 1,
                'no_ktp' => '3220064739419287',
                'nama' => 'Viktor Endra Hidayat',
                'jenis_kelamin' => 'P',
                'agama' => 'Kristen',
                'pekerjaan' => 'Seniman',
                'telp' => '(+62) 799 8319 4639',
                'email' => 'asimanjuntak@example.org'
            ]
        ]);
    }
    
    // Method untuk refresh cache secara manual
    public function refreshCache()
    {
        Cache::forget('external_jabatan');
        Cache::forget('external_lembaga');
        Cache::forget('external_warga');
        
        return response()->json(['message' => 'Cache refreshed successfully']);
    }
}