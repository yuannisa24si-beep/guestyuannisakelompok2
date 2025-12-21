<?php
try {
    // Test connection
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    echo "✓ MySQL connection successful\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'yuannisa-2sie_laravel'");
    $db_exists = $stmt->fetch();
    
    if ($db_exists) {
        echo "✓ Database 'yuannisa-2sie_laravel' exists\n";
        
        // Connect to specific database
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=yuannisa-2sie_laravel', 'root', '');
        echo "✓ Connected to yuannisa-2sie_laravel database\n";
        
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
        } else {
            echo "✗ Lembaga table not found\n";
        }
        
    } else {
        echo "✗ Database 'yuannisa-2sie_laravel' does not exist\n";
        echo "Creating database...\n";
        $pdo->exec("CREATE DATABASE `yuannisa-2sie_laravel`");
        echo "✓ Database created successfully\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "✗ General error: " . $e->getMessage() . "\n";
}
?>