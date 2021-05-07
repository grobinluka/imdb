<?php

session_start();

$root_path = '/imdb';

//neprijavljen uporabnik lahko obišče...

$allowed = [
    $root_path.'/index.php',
    $root_path.'/user_add.php',
    $root_path.'/user_insert.php',
    $root_path.'/login.php',
    $root_path.'/login_check.php'
];

//če uporabnik ni prijavljen in ne obiskuje dovoljenih strani - ga preusmeri na prijavo
if(!isset($_SESSION['user_id'])&& (!in_array($_SERVER['REQUEST_URI'], $allowed))){
    header("Location: login.php"); die();
}



/**
 * 
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


?>