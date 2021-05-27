<?php
    include_once "header.php";

    adminOnly();

    include_once "db.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM genres WHERE genre_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o tem žanru, ki ga urejam
    $genre = $stmt->fetch();
?>

<h2>Uredi žanr</h2>

<form action="genre_update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $genre['genre_id']; ?>" />
    <input class="form-control" value="<?php echo $genre['genre']; ?>" type="text" name="genre" required="required" /><br />
    <input class="form-control" value="<?php echo $genre['short']; ?>" type="text" name="short" /><br />

    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
    include_once "footer.php";
?>