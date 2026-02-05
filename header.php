<?php if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Inventory System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<header class="bg-teal-600 text-white p-4 flex justify-between">
  <h1 class="font-bold">Inventory Management</h1>
  <div>
    <span class="mr-4">Welcome, <?= htmlspecialchars($_SESSION['user']) ?></span>
    <a href="logout.php" class="underline">Logout</a>
  </div>
  <nav class="space-x-4">
  <a href="index.php">Dashboard</a>
  <a href="product-list.php">Products</a>
  <a href="categories.php">Categories</a>
  <a href="suppliers.php">Suppliers</a>
  <a href="reports.php">Reports</a>
  <a href="activity.php">Logs</a>
  <a href="users.php">Users</a>
</nav>

</header>
<main class="p-6">
