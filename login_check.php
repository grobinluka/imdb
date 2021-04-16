<?php 

include_once "session.php";
include_once "db.php";

$email = $_POST['email'];
$pass = $_POST['pass'];

//preverim ali so podatki polni
if(!empty($email) && !empty($pass)){

    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]); //dobi vse zapise iz baze kjer se ujema email

    //ali obstaja user s to e-pošto
    if($stmt->rowCount() == 1){
        $user = $stmt->fetch(); //v spremenljivko user shranim podatke iz baze
        
        //preverim ali se gesli ujemata
        if(password_verify($pass, $user['pass'])){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['admin'] = $user['admin'];
            
            header("Location: index.php"); die();
        }
    }
}

//nazaj na login
header("Location: login.php"); die();

?>