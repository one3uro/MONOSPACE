<?php
include 'dbconnect.php';

try{
    $stmt = $pdo->query("SELECT * FROM tasks");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks);
} catch(PDOException $e){
    header('Content-Type: application/json', true, 500);
    echo json_encode(["error" => "Task could not be retreived. It either failed to load or does not exist."]);
}
?>
