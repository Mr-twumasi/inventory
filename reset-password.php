<?php
require 'config.php';

if ($_SESSION['role'] !== 'admin') die("Access denied");

$id = $_GET['id'];

$newPassword = "password123"; // default reset password
$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
$stmt->execute([$hashed, $id]);

header("Location: users.php");
