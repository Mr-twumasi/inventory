<?php
function logActivity($pdo, $user, $action) {
  $stmt = $pdo->prepare(
    "INSERT INTO activity_logs (user, action) VALUES (?, ?)"
  );
  $stmt->execute([$user, $action]);
}
