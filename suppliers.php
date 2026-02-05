<?php
require 'config.php';
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $pdo->prepare(
    "INSERT INTO suppliers (name, contact_info) VALUES (?, ?)"
  );
  $stmt->execute([$_POST['name'], $_POST['contact_info']]);
}

$sups = $pdo->query("SELECT * FROM suppliers")->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">Suppliers</h2>

<form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-4">
  <input name="name" placeholder="Supplier Name"
    class="border p-2" required>
  <input name="contact_info" placeholder="Contact Info"
    class="border p-2">
  <button class="bg-teal-600 text-white rounded">Add</button>
</form>

<table class="bg-white w-full rounded shadow">
<?php foreach ($sups as $s): ?>
  <tr class="border-t">
    <td class="p-2"><?= htmlspecialchars($s['name']) ?></td>
    <td class="p-2"><?= htmlspecialchars($s['contact_info']) ?></td>
    <td class="p-2 text-right">
      <a href="delete-supplier.php?id=<?= $s['id'] ?>"
         class="text-red-600 underline">Delete</a>
    </td>
  </tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>
