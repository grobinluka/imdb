<?php
    include_once "session.php";
    include_once "db.php";

    $genre = $_POST['genre'];
    $short = $_POST['short'];
    $id = (int)$_POST['id'];

    //preverim, če je genre vnešen
    if((!empty($genre)) && (!empty($id))){
        $query = "UPDATE genres SET genre = ?, short = ? WHERE genre_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$genre, $short, $id]);

        //preusmeri na seznam vseh žanrov
        header("Location: genres.php"); die();
    }



    //preusmeri nazaj na vnos - nekaj je narobe
    header("Location: genre_edit.php?id=$id"); die();

?>