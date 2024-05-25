<?php

$host = 'localhost';
$port = '5432';
$dbname = 'toko_online_web_s2';
$user = 'postgres';
$password = 'postgres';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the PostgreSQL database!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
