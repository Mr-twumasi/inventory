<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');   // 🔴 THIS WAS MISSING
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

if (!$host || !$port || !$dbname || !$user) {
  die("Missing database environment variables");
}

try {
  $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;connect_timeout=5";
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("DB Connection Error: " . $e->getMessage());
}

session_start();
?>
