<?php
require 'config.php';
require 'header.php';

$id = $_GET['id'];

$product = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$product->execute([$id]);
$product = $product->fetch();

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$suppliers = $pdo->query("SELECT * FROM suppliers")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $pdo->prepare("
    UPDATE products
    SET name=?, category_id=?, sku=?, quantity=?, price=?, supplier_id=?
    WHERE id=?
  
  ");

  require 'log.php';
logActivity($pdo, $_SESSION['user'], "Updated product ID: $id");


  $stmt->execute([
    $_POST['name'],
    $_POST['category_id'],
    $_POST['sku'],
    $_POST['quantity'],
    $_POST['price'],
    $_POST['supplier_id'],
    $id
  ]);

  header("Location: product-list.php");
  exit;
}
?>

<h2 class="text-2xl font-bold mb-6">Edit Product</h2>

<form method="POST" class="bg-white p-6 rounded shadow max-w-xl">

  <input name="name" value="<?= $product['name'] ?>"
    class="w-full border p-2 mb-4" required>

  <input name="sku" value="<?= $product['sku'] ?>"
    class="w-full border p-2 mb-4" required>

  <input type="number" name="quantity" value="<?= $product['quantity'] ?>"
    class="w-full border p-2 mb-4" required>

  <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>"
    class="w-full border p-2 mb-4" required>

  <select name="category_id" class="w-full border p-2 mb-4">
    <?php foreach ($categories as $c): ?>
      <option value="<?= $c['id'] ?>"
        <?= $c['id'] == $product['category_id'] ? 'selected' : '' ?>>
        <?= $c['name'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <select name="supplier_id" class="w-full border p-2 mb-4">
    <?php foreach ($suppliers as $s): ?>
      <option value="<?= $s['id'] ?>"
        <?= $s['id'] == $product['supplier_id'] ? 'selected' : '' ?>>
        <?= $s['name'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <button class="bg-teal-600 text-white px-4 py-2 rounded">
    Update Product
  </button>

</form>

<?php require 'footer.php'; ?>
