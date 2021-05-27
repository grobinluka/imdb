<?php
    include_once "session.php";
    
    adminOnly();

    include_once "db.php";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $nickname = $_POST['nickname'];

    //preverim, če je igralec vnešen
    if((!empty($first_name)) && (!empty($last_name))){
        $query = "INSERT INTO actors(first_name, last_name, nickname) VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$first_name, $last_name, $nickname]);

        //preusmeri na seznam vseh igralcov
        header("Location: actors.php"); die();
    }



    //preusmeri nazaj na vnos - nekaj je narobe
    header("Location: actor_add.php"); die();

?>