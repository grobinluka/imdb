<?php

include_once "session.php";
    
adminOnly();

include_once "db.php";

$id = (int) $_GET['id'];

$query = "DELETE FROM actors WHERE actor_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

header("Location: actors.php"); die();


?>