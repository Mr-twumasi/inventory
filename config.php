<?php
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'inventory_db';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASS') ?: '';

try {
  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}

session_start();
?>
