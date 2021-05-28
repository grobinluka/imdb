<?php

include_once 'session.php';
include_once 'db.php';
include_once 'functions.php';

$user_id = $_SESSION['user_id'];
$movie_id = (int) $_POST['movie_id'];
$rating = (int) $_POST['star'];

if(canUserRateMovie($user_id, $movie_id)){
    $query = "INSERT INTO ratings (rating, user_id, movie_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$rating, $user_id, $movie_id]);


    //pridobim povprečno vrednost ocen za film
    $query = "SELECT AVG(rating) as avg FROM ratings WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$movie_id]);
    $r = $stmt->fetch();
    $avg = $r['avg'];


    //posodobim film - povprečje ocene
    $query = "UPDATE movies SET rating = ? WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$avg, $movie_id]);
}

header("Location: movie.php?id=$movie_id"); die();

?>