<?php

try{
    $pdo = new PDO("mysql: host=localhost;dbname=task_organiser", "root","");
} catch (PDOException $e){
    header('Content-Type: application/json', true, 500);
    die(json_encode(["error" => "Database connection failed."]));
    
}


?>