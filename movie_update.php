<?php
    include_once "session.php";
    include_once "db.php";

    $id = (int) $_POST['id'];
    $title = $_POST['title'];
    $duration = (int)$_POST['duration'];
    $release_year = (int)$_POST['release_year'];
    $description = $_POST['description'];
    $genres = $_POST['genres'];
    $user_id = $_SESSION['user_id'];

    if((!empty($title))){
        $query = "UPDATE movies SET title = ?,  duration = ?, release_year = ?, description = ? WHERE movie_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $duration, $release_year, $description, $id]);
      
        //vse žanre, kateremu film pripada, najprej izbrišem
        $query = "DELETE FROM genres_movies WHERE movie_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        //vnesi žanre
        foreach($genres as $genre_id){
            $query = "INSERT INTO genres_movies(movie_id, genre_id) VALUES(?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id, $genre_id]);
        }

        header("Location: movies.php"); die();
    }

    header("Location: movie_edit.php?id=$id"); die();

?>