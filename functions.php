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

function getActorAvatar($actor_id){
    require "db.php";
    $query = "SELECT * FROM actors_images WHERE actor_id = ? ORDER BY date_add ASC LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$actor_id]);
    
    $result = $stmt->fetch();

    if(!empty($result['url'])){
        return $result['url'];
    }
    else{
        return './assets/img/no-avatar.jpg';
    }
}

/**
 * Pretvori minute dolžine filma v obliko ure in minute
 */
function fromDateToString($minutes){
    $minutes = (int) $minutes;

    if(empty($minutes)){
        return;
    }
    else{
        $hour = floor($minutes / 60);
        $minutes = $minutes - ($hour * 60);
        return "$hour h $minutes min";
    }

}

/**
 * Vrača vse žanre, ki jih ima film
 */

function getGenres($movie_id){
    require 'db.php';

    $query = "SELECT g.* FROM genres g INNER JOIN genres_movies gm ON gm.genre_id = g.genre_id WHERE gm.movie_id=? ORDER BY g.genre";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$movie_id]);

    $return = "";

    while($row = $stmt->fetch()){
        if(!empty($return)){
            $return = $return.', ';
        }
        $return = $return.$row['genre'];
    }
    return $return;
}


function getMovieRate($movie_id){
    require 'db.php';

    $query = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$movie_id]);

    $movie = $stmt->fetch();

    $result = 'N/A';

    if(!empty($movie['rating'])){
        $result = $movie['rating'];
    }

    return $result;
}


function canUserRateMovie($user_id, $movie_id){
    require 'db.php';

    $query = "SELECT * FROM ratings WHERE user_id = ? AND movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $movie_id]);

    if($stmt->rowCount() == 0){
        return 1;
    }
    else{
        return 0;
    }

}

function canCurrentUserDeleteComment($comment_id){

    require 'db.php';
    
    $user_id = $_SESSION['user_id'];

    if(isset($_SESSION['admin']) && ($_SESSION['admin'] == 1)){
        return 1;
    }
    else{
        $query = "SELECT * FROM comments WHERE comment_id = ? AND user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$comment_id, $user_id]);

        if($stmt->rowCount() == 0){
            return 0;
        }
        else{
            return 1;
        }
    }
    

}

?>