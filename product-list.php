<?php
require 'config.php';
require 'header.php';

$search = $_GET['search'] ?? "";

$stmt = $pdo->prepare("
  SELECT p.*, c.name AS category, s.name AS supplier
  FROM products p
  LEFT JOIN categories c ON p.category_id = c.id
  LEFT JOIN suppliers s ON p.supplier_id = s.id
  WHERE p.name LIKE ? OR p.sku LIKE ?
  ORDER BY p.created_at DESC
");

$like = "%$search%";
$stmt->execute([$like, $like]);
$products = $stmt->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">Products</h2>

<form class="mb-4 flex gap-2">
  <input name="search"
         value="<?= htmlspecialchars($search) ?>"
         placeholder="Search by name or SKU"
         class="border p-2 flex-1">

  <button class="bg-teal-600 text-white px-4 rounded">
    Search
  </button>
</form>

<div class="overflow-x-auto bg-white rounded shadow">
<table class="w-full text-sm">
  <thead class="bg-gray-100">
    <tr>
      <th class="p-2 text-left">Name</th>
      <th class="p-2">SKU</th>
      <th class="p-2">Category</th>
      <th class="p-2">Supplier</th>
      <th class="p-2">Qty</th>
      <th class="p-2">Price</th>
      <th class="p-2">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($products as $p): ?>
    <tr class="border-t">
      <td class="p-2"><?= htmlspecialchars($p['name']) ?></td>
      <td class="p-2"><?= $p['sku'] ?></td>
      <td class="p-2"><?= $p['category'] ?></td>
      <td class="p-2"><?= $p['supplier'] ?></td>
      <td class="p-2 <?= $p['quantity'] < 10 ? 'text-red-600 font-bold' : '' ?>">
        <?= $p['quantity'] ?>
      </td>
      <td class="p-2">₵<?= number_format($p['price'], 2) ?></td>
      <td class="p-2 flex gap-2">

        <a href="edit-product.php?id=<?= $p['id'] ?>"
           class="text-blue-600 underline">Edit</a>

        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="delete-product.php?id=<?= $p['id'] ?>"
             onclick="return confirm('Delete this product?')"
             class="text-red-600 underline">Delete</a>
        <?php endif; ?>

      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>

<?php require 'footer.php'; ?>
