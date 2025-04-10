<?php
include '../../app/config/database.php';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_PERSISTENT => true, 
];
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME,DB_PASSWORD, $options);
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage(), 3, '../../public/logs/error_logs.log');
    die("Koneksi gagal: " . $e->getMessage());
}
