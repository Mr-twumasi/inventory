<?php
$host = getenv('PGHOST') ?: 'localhost';
$dbname = getenv('PGNAME') ?: 'inventory_db';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: '';
$port = getenv('PGPORT')?: '';

try {
  $pdo = new PDO("pgsql:host=$host;port= $port; dbname=$dbname", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}

session_start();
?>
