<?php
    include_once "session.php";

    adminOnly();

    include_once "db.php";

    $genre = $_POST['genre'];
    $short = $_POST['short'];

    //preverim, če je genre vnešen
    if(!empty($genre)){
        $query = "INSERT INTO genres(genre, short) VALUES (?, ?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$genre, $short]);

        //preusmeri na seznam vseh žanrov
        header("Location: genres.php"); die();
    }



    //preusmeri nazaj na vnos - nekaj je narobe
    header("Location: genre_add.php"); die();

?>