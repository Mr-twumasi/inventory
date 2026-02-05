<?php
require 'config.php';
require 'header.php';

if ($_SESSION['role'] !== 'admin') {
  die("Access denied");
}

/* Add User */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $pdo->prepare(
    "INSERT INTO users (username, password, role) VALUES (?, ?, ?)"
  );
  $stmt->execute([
    $_POST['username'],
    $hashed,
    $_POST['role']
  ]);
}

/* Fetch Users */
$users = $pdo->query("SELECT id, username, role FROM users")->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">User Management</h2>

<form method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-6 bg-white p-4 rounded shadow">

  <input name="username" placeholder="Username"
    class="border p-2" required>

  <input type="password" name="password" placeholder="Password"
    class="border p-2" required>

  <select name="role" class="border p-2">
    <option value="staff">Staff</option>
    <option value="admin">Admin</option>
  </select>

  <button class="bg-teal-600 text-white rounded">
    Add User
  </button>

</form>

<table class="bg-white w-full rounded shadow text-sm">
  <tr class="bg-gray-100">
    <th class="p-2 text-left">Username</th>
    <th class="p-2">Role</th>
    <th class="p-2">Actions</th>
  </tr>

  <?php foreach ($users as $u): ?>
  <tr class="border-t">
    <td class="p-2"><?= htmlspecialchars($u['username']) ?></td>
    <td class="p-2"><?= $u['role'] ?></td>
    <td class="p-2">
      <a href="reset-password.php?id=<?= $u['id'] ?>"
         class="text-blue-600 underline">Reset Password</a>

      <?php if ($u['username'] !== $_SESSION['user']): ?>
        | <a href="delete-user.php?id=<?= $u['id'] ?>"
             onclick="return confirm('Delete user?')"
             class="text-red-600 underline">Delete</a>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>
