<?php 
include_once "header.php";
?>

<h3>Prijava</h3>

<form action="login_check.php" method="post">
    <input type="email" name="email" placeholder="Vnesi epošto" required="required" /><br />
    <input type="password" name="pass" placeholder="Vnesi geslo" required="required" /><br />

    <input type="submit" value="Prijavi"/>
</form>

<?php
include_once "footer.php";
?>