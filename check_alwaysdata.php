<?php
try {
    echo "Testing AlwaysData connection...\n";
    
    $host = 'mysql-yuannisa-2sie.alwaysdata.net';
    $database = 'yuannisa-2sie_laravel';
    $username = '446607_yuasie';
    $password = 'anakpakijal';
    
    // Test connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    echo "✓ AlwaysData connection successful\n";
    
    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "✓ Tables found: " . count($tables) . "\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
    
    // Check lembaga table specifically
    if (in_array('lembaga', $tables)) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM lembaga");
        $count = $stmt->fetchColumn();
        echo "✓ Lembaga table has $count records\n";
        
        // Show sample data
        $stmt = $pdo->query("SELECT * FROM lembaga LIMIT 3");
        $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Sample data:\n";
        foreach ($samples as $sample) {
            echo "  - ID: {$sample['lembaga_id']}, Nama: {$sample['nama_lembaga']}\n";
        }
    } else {
        echo "✗ Lembaga table not found - need to run migrations\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
    echo "This might mean:\n";
    echo "1. Database credentials are wrong\n";
    echo "2. Database doesn't exist on AlwaysData\n";
    echo "3. Network connection issue\n";
} catch (Exception $e) {
    echo "✗ General error: " . $e->getMessage() . "\n";
}
?>