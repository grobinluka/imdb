<?php
    include_once "header.php";

    adminOnly();

    include_once "db.php";
?>

<h2>Dodaj film</h2>

<form action="movie_insert.php" method="post">
    <input class="form-control" type="text" name="title" placeholder="Vnesi naslov filma" required="required" /><br />
    <input class="form-control" type="number" name="duration" placeholder="Vnesi dolžino filma (v min)" /><br />
    <input class="form-control" type="number" name="release_year" placeholder="Vnesi letnico filma" /><br />
    <textarea class="form-control" name="description" cols="15" rows="5"></textarea><br />
    <div class="form-control">
    	<?php 
            $query = "SELECT * FROM genres";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while($row = $stmt->fetch()){
                echo '<input type="checkbox" name="genres[]" value="'.$row['genre_id'].'" />'.$row['genre'].'<br />';
            }

        ?>
    </div>
    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
    include_once "footer.php";
?>