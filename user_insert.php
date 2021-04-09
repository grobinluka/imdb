<?php 

include_once "db.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

//preverim ali so podatki polni
if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($pass1) && ($pass1 == $pass2)){
    //vnos v bazo
    $pass = password_hash($pass1, PASSWORD_DEFAULT);
    $query = "INSERT INTO users(first_name, last_name, email, pass) VALUES(?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name, $last_name, $email, $pass]);
}

//nazaj na registracijo

?>