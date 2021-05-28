<?php

include_once "session.php";
include_once "db.php";

$id = (int) $_POST['id'];
$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

if(!empty($content)){
    $query = "INSERT INTO comments(content, movie_id, user_id) VALUES (?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$content, $id, $user_id]);


    msg('Komentar dodan!');
}

header("Location: movie.php?id=$id#komentar-sidro"); die();

?>