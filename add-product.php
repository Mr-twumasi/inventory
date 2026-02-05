<?php
require 'config.php';
require 'header.php';

/* Fetch dropdown data */
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$suppliers = $pdo->query("SELECT * FROM suppliers")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $pdo->prepare("
    INSERT INTO products (name, category_id, sku, quantity, price, supplier_id)
    VALUES (?, ?, ?, ?, ?, ?)
   
  ");

  require 'log.php';
  logActivity($pdo, $_SESSION['user'], "Added product: " . $_POST['name']);
  

  $stmt->execute([
    $_POST['name'],
    $_POST['category_id'],
    $_POST['sku'],
    $_POST['quantity'],
    $_POST['price'],
    $_POST['supplier_id']
  ]);

  header("Location: index.php");
  exit;
}
?>

<h2 class="text-2xl font-bold mb-6">Add Product</h2>

<form method="POST" class="bg-white p-6 rounded shadow max-w-xl">

  <input name="name" placeholder="Product Name"
    class="w-full border p-2 mb-4" required>

  <input name="sku" placeholder="SKU"
    class="w-full border p-2 mb-4" required>

  <input type="number" name="quantity" placeholder="Quantity"
    class="w-full border p-2 mb-4" required>

  <input type="number" step="0.01" name="price" placeholder="Price"
    class="w-full border p-2 mb-4" required>

  <select name="category_id" class="w-full border p-2 mb-4">
    <option value="">Select Category</option>
    <?php foreach ($categories as $c): ?>
      <option value="<?= $c['id'] ?>">
        <?= htmlspecialchars($c['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <select name="supplier_id" class="w-full border p-2 mb-4">
    <option value="">Select Supplier</option>
    <?php foreach ($suppliers as $s): ?>
      <option value="<?= $s['id'] ?>">
        <?= htmlspecialchars($s['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <button class="bg-teal-600 text-white px-4 py-2 rounded">
    Save Product
  </button>

</form>

<?php require 'footer.php'; ?>
