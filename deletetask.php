<?php
include 'dbconnect.php';

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
$stmt->execute([$_POST['id']]);

echo json_encode(["success" => true]);
?>