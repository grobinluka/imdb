<?php

    include_once "session.php";

    adminOnly();

    include_once "db.php";

    $movie_id = (int) $_POST['movie_id'];
    $actors = $_POST['actors'];
    $role = $_POST['role'];

    $query = "DELETE FROM roles WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$movie_id]);


    foreach($actors as $actor_id){
        $query = "INSERT INTO roles(movie_id, actor_id, role) VALUES(?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$movie_id, $actor_id, $role[$actor_id]]);
    }

    header("Location: movie.php?id=$movie_id"); die();

?>