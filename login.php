<?php 
include_once "header.php";
?>

<h3>Prijava</h3>

<form action="login_check.php" method="post">
    <input class="form-control" type="email" name="email" placeholder="Vnesi epošto" required="required" /><br />
    <input class="form-control" type="password" name="pass" placeholder="Vnesi geslo" required="required" /><br />

    <input type="submit" class="btn btn-primary" value="Prijavi"/>
</form>

<?php
include_once "footer.php";
?>