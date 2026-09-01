
<?php
include 'dbconnect.php';

$stmt = $pdo->prepare("INSERT INTO tasks (name, status) VALUES (?, ?)");
$stmt->execute([$_POST['name'], $_POST['status']]);

echo json_encode(["success" => true]);
?>