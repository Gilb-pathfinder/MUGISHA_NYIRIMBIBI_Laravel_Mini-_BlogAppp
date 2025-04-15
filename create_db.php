<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS blogs_ap";
    $pdo->exec($sql);
    
    echo "Database created successfully\n";
} catch(PDOException $e) {
    echo "Error creating database: " . $e->getMessage() . "\n";
}
?> 