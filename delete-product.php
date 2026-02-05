<?php
require 'config.php';

if ($_SESSION['role'] !== 'admin') {
  die("Access denied");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

require 'log.php';
logActivity($pdo, $_SESSION['user'], "Deleted product ID: $id");


header("Location: product-list.php");
exit;
