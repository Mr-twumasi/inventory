<?php
require 'config.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header("Location: index.php");
    exit;
  } else {
    $error = "Invalid login credentials";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<form method="POST" class="bg-white p-8 rounded shadow w-96">
  <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

  <?php if ($error): ?>
    <p class="text-red-500 mb-4"><?= $error ?></p>
  <?php endif; ?>

  <input name="username" placeholder="Username"
    class="w-full border p-2 mb-4" required>

  <input type="password" name="password" placeholder="Password"
    class="w-full border p-2 mb-4" required>

  <button class="w-full bg-teal-600 text-white p-2 rounded">
    Login
  </button>
</form>

</body>
</html>
