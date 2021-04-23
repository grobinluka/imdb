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

<h2><?php echo $actor['first_name'].' '.$actor['last_name']; ?></h2>
<h6><?php echo $actor['nickname']; ?></h6>

<div id="slike">
    <?php
        //preverim ali igralec ima slike
        $query = "SELECT * FROM actors_images WHERE actor_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        while($row = $stmt->fetch()){
            echo '<img src="'.$row['url'].'" width="150" alt="'.$row['title'].'"/>';
        }
    ?>
</div>
<hr>
<form action="actor_image_upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $actor['actor_id']; ?>" /><br />
        <input class="form-control" type="text" name="title" placeholder="Vnesi naslov slike" /><br />
        <input type="file" name="file"/><br /><br />

        <input type="submit" name="name" class="btn btn-primary" value="Naloži"/>
    </form>


<?php
    include_once "footer.php";
?>