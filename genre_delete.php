<?php

include_once "session.php";

adminOnly();

include_once "db.php";

$id = (int) $_GET['id'];

$query = "DELETE FROM genres WHERE genre_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

header("Location: genres.php"); die();


?>