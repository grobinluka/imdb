<?php
    include_once "session.php";
    include_once "db.php";

    $title = $_POST['title'];
    $duration = (int)$_POST['duration'];
    $release_year = (int)$_POST['release_year'];
    $description = $_POST['description'];
    $genres = $_POST['genres'];
    $user_id = $_SESSION['user_id'];

    if((!empty($title))){
        $query = "INSERT INTO movies(title, duration, release_year, description, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $duration, $release_year, $description, $user_id]);

        //id novo vnešenega filma
        $movie_id = $pdo->lastInsertId();
        //vnesi žanre
        foreach($genres as $genre_id){
            $query = "INSERT INTO genres_movies(movie_id, genre_id) VALUES(?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$movie_id, $genre_id]);
        }

        header("Location: movies.php"); die();
    }

    header("Location: movie_add.php"); die();

?>