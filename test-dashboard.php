<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Database Test Results:\n";
echo "======================\n\n";

$tables = [
    'warga' => 'Warga',
    'lembaga' => 'Lembaga Desa',
    'jabatan_lembaga' => 'Jabatan',
    'perangkat_desa' => 'Perangkat Desa',
    'rw' => 'RW',
    'rt' => 'RT',
    'anggota_lembaga' => 'Anggota Lembaga',
    'users' => 'Users'
];

foreach ($tables as $table => $label) {
    try {
        $count = DB::table($table)->count();
        echo "✓ {$label} ({$table}): {$count} records\n";
    } catch (\Exception $e) {
        echo "✗ {$label} ({$table}): ERROR - " . $e->getMessage() . "\n";
    }
}

echo "\n";
echo "Dashboard Query Test:\n";
echo "=====================\n\n";

$queries = [
    'Total Warga' => "SELECT COUNT(*) as count FROM warga",
    'Total Users (Admin)' => "SELECT COUNT(*) as count FROM warga WHERE role = 'admin'",
    'Total Lembaga' => "SELECT COUNT(*) as count FROM lembaga",
    'Total Jabatan' => "SELECT COUNT(*) as count FROM jabatan_lembaga",
    'Total Perangkat' => "SELECT COUNT(*) as count FROM perangkat_desa",
    'Total RW' => "SELECT COUNT(*) as count FROM rw",
    'Total RT' => "SELECT COUNT(*) as count FROM rt",
    'Total Anggota Lembaga' => "SELECT COUNT(*) as count FROM anggota_lembaga"
];

foreach ($queries as $label => $query) {
    try {
        $result = DB::selectOne($query);
        echo "✓ {$label}: {$result->count}\n";
    } catch (\Exception $e) {
        echo "✗ {$label}: ERROR\n";
    }
}
