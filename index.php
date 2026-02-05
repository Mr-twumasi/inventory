<?php
require 'config.php';
require 'header.php';

/* Total Products */
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();

/* Low Stock */
$lowStock = $pdo->query(
  "SELECT COUNT(*) FROM products WHERE quantity < 10"
)->fetchColumn();

/* Recent Products */
$recent = $pdo->query(
  "SELECT name, created_at FROM products ORDER BY created_at DESC LIMIT 5"
)->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">Dashboard</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

  <div class="bg-white p-6 rounded shadow">
    <h3 class="text-gray-500">Total Products</h3>
    <p class="text-3xl font-bold"><?= $totalProducts ?></p>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <h3 class="text-gray-500">Low Stock Items</h3>
    <p class="text-3xl font-bold text-red-500"><?= $lowStock ?></p>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <h3 class="text-gray-500">Quick Actions</h3>
    <a href="product-list.php"
   class="inline-block mt-2 border border-teal-600 text-teal-600 px-4 py-2 rounded">
   View Products
</a>


    <a href="add-product.php"
       class="inline-block mt-2 bg-teal-600 text-white px-4 py-2 rounded">
       + Add Product
    </a>
  </div>

</div>

<div class="bg-white p-6 rounded shadow">
  <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
  <ul>
    <?php foreach ($recent as $r): ?>
      <li class="border-b py-2">
        <?= htmlspecialchars($r['name']) ?>
        <span class="text-sm text-gray-400">
          (<?= $r['created_at'] ?>)
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<?php require 'footer.php'; ?>
