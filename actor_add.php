<?php
    include_once "header.php";
?>

<h2>Dodaj igralca</h2>

<form action="actor_insert.php" method="post">
    <input class="form-control" type="text" name="first_name" placeholder="Vnesi ime igralca" required="required" /><br />
    <input class="form-control" type="text" name="last_name" placeholder="Vnesi priimek igralca" /><br />
    <input class="form-control" type="text" name="nickname" placeholder="Vnesi vzdevek" /><br />

    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
    include_once "footer.php";
?>