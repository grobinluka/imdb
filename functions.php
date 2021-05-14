<?php 

function getUserName($user_id){
    require "db.php";
    $query = "SELECT first_name, last_name FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);

    $user = $stmt->fetch();

    return $user['first_name'].' '.$user['last_name'];
}


function getUserAvatar($user_id){
    require "db.php";
    $query = "SELECT first_name, last_name FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);

    $user = $stmt->fetch();

    if(!empty($user['avatar'])){
        return $user['avatar'];
    }
    else{
        return './assets/img/no-avatar.jpg';
    }
}


function getSloDateTime($timestamp){
    //dd.mm.yy @ hh:mm
    return date('j. n. Y @ G:i', strtotime($timestamp));
}


function getMovieData($movie_id){
    require "db.php";
    $query = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$movie_id]);

    return $stmt->fetch();
}

?>