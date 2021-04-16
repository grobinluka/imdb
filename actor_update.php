<?php
    include_once "session.php";
    include_once "db.php";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $nickname = $_POST['nickname'];
    $id = (int)$_POST['id'];

    //preverim, če je igralec vnešen
    if((!empty($first_name)) && (!empty($last_name))){
        $query = "UPDATE actors SET first_name = ?, last_name = ?, nickname = ? WHERE actor_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$first_name, $last_name, $nickname, $id]);

        //preusmeri na seznam vseh žanrov
        header("Location: actors.php"); die();
    }



    //preusmeri nazaj na vnos - nekaj je narobe
    header("Location: actor_edit.php?id=$id"); die();

?>