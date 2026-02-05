<?php
require 'config.php';
require 'header.php';

$products = $pdo->query(
  "SELECT name, sku, quantity, price FROM products"
)->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">Reports</h2>

<p class="mb-4 text-gray-500">
  Export-ready product listing (Excel/PDF can be added)
</p>

<table class="bg-white w-full rounded shadow text-sm">
<?php foreach ($products as $p): ?>
<tr class="border-t">
  <td class="p-2"><?= $p['name'] ?></td>
  <td class="p-2"><?= $p['sku'] ?></td>
  <td class="p-2"><?= $p['quantity'] ?></td>
  <td class="p-2">₵<?= number_format($p['price'],2) ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>
