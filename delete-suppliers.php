<?php
require 'config.php';
if ($_SESSION['role'] !== 'admin') die("Access denied");

$stmt = $pdo->prepare("DELETE FROM suppliers WHERE id=?");
$stmt->execute([$_GET['id']]);

header("Location: suppliers.php");
