<?php
require 'config.php';
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
  $stmt->execute([$_POST['name']]);
}

$cats = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">Categories</h2>

<form method="POST" class="flex gap-2 mb-4">
  <input name="name" placeholder="New Category"
    class="border p-2 flex-1" required>
  <button class="bg-teal-600 text-white px-4 rounded">Add</button>
</form>

<table class="bg-white w-full rounded shadow">
<?php foreach ($cats as $c): ?>
  <tr class="border-t">
    <td class="p-2"><?= htmlspecialchars($c['name']) ?></td>
    <td class="p-2 text-right">
      <a href="delete-category.php?id=<?= $c['id'] ?>"
         class="text-red-600 underline">Delete</a>
    </td>
  </tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>
