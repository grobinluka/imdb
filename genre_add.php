<?php
    include_once "header.php";
?>

<h2>Dodaj žanr</h2>

<form action="genre_insert.php" method="post">
    <input class="form-control" type="text" name="genre" placeholder="Vnesi ime žanra" required="required" /><br />
    <input class="form-control" type="text" name="short" placeholder="Vnesi kratico žanra" /><br />

    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
    include_once "footer.php";
?>