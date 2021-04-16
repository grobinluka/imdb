<?php
    include_once "header.php";
    include_once "db.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM actors WHERE actor_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o tem igralcu, ki ga urejam
    $actor = $stmt->fetch();
?>

<h2>Uredi igralca</h2>

<form action="actor_update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $actor['actor_id']; ?>" />
    <input class="form-control" value="<?php echo $actor['first_name']; ?>" type="text" name="first_name" required="required" /><br />
    <input class="form-control" value="<?php echo $actor['last_name']; ?>" type="text" name="last_name" /><br />
    <input class="form-control" value="<?php echo $actor['nickname']; ?>" type="text" name="nickname" /><br />

    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
    include_once "footer.php";
?>