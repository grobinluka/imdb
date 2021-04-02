<?php
    include_once 'header.php';
?>

<h3>Registracija</h3>

<form action="user_insert.php" method="post">
    <input type="text" name="first_name" placeholder="Vnesi ime" required="required" /><br />
    <input type="text" name="last_name" placeholder="Vnesi priimek" required="required" /><br />
    <input type="email" name="email" placeholder="Vnesi epošto" required="required" /><br />
    <input type="password" name="pass1" placeholder="Vnesi geslo" required="required" /><br />
    <input type="password" name="pass2" placeholder="Vnesi ponovno geslo" required="required" /><br />

    <input type="submit" name="submit" value="Registriraj"/>
</form>

<?php
    include_once 'footer.php';
?>