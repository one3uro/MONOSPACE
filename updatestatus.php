<?php
include 'dbconnect.php';

$stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
$stmt->execute([$_POST['status'], $_POST['id']]);

echo json_encode(["success" => true]);
?>