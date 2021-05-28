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
 * Funkcija vrača ali je trenutno prijavljeni uporabnik administrator
 */

 function isAdmin(){
    if(isset($_SESSION['admin'])){
        return $_SESSION['admin'];
    }
    else{
        return 0;
    }
    
 }


 /**
 * Funkcija preverja omogoča dostop do strani le administratorjem, ostale preusmeri na index
 */

 function adminOnly(){
    if((!isset($_SESSION['admin'])) || (!isAdmin())) {
        header("Location: index.php"); die();
    }
 }

  /**
 * Funkcija nam dodaja sporočilo v sistem
 * content: besedilo
 * type: napaka, uspeh
 */
 function msg($content, $type = 'uspeh'){
    $_SESSION['msg'] = $content;
    $_SESSION['msg_type'] = $type;
 }


?>