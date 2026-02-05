<?php
require 'config.php';
require 'header.php';

$logs = $pdo->query(
  "SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT 100"
)->fetchAll();
?>

<h2 class="text-2xl font-bold mb-6">Activity Logs</h2>

<table class="bg-white w-full rounded shadow text-sm">
<?php foreach ($logs as $l): ?>
  <tr class="border-t">
    <td class="p-2"><?= $l['created_at'] ?></td>
    <td class="p-2"><?= htmlspecialchars($l['user']) ?></td>
    <td class="p-2"><?= htmlspecialchars($l['action']) ?></td>
  </tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>
