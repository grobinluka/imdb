<?php
    include_once "header.php";
    include_once "db.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    //iz baze preberem vse o tem igralcu, ki ga urejam
    $movie = $stmt->fetch();
?>

<h2>Uredi film</h2>

<form action="movie_update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $movie['movie_id']; ?>" />
    <input class="form-control" type="text" name="title" value="<?php echo $movie['title']; ?>" required="required" /><br />
    <input class="form-control" type="number" name="duration" value="<?php echo $movie['duration']; ?>" /><br />
    <input class="form-control" type="number" name="release_year" value="<?php echo $movie['release_year']; ?>"; /><br />
    <textarea class="form-control" name="description" cols="15" rows="5"><?php echo $movie['description']; ?></textarea><br />
    <div class="form-control">
    	<?php 
            //v array shranim vse žanre ki jih ima ta film

            $query = "SELECT genre_id FROM genres_movies WHERE movie_id =?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id]);
            
            $genres = array();
            while($row = $stmt->fetch()){
                $genres[] = $row['genre_id'];
            }
            
            $query = "SELECT * FROM genres";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while($row = $stmt->fetch()){
                if(in_array($row['genre_id'], $genres)){
                    echo '<input type="checkbox" checked="checked" name="genres[]" value="'.$row['genre_id'].'" />'.$row['genre'].'<br />';
                }
                else{
                    echo '<input type="checkbox" name="genres[]" value="'.$row['genre_id'].'" />'.$row['genre'].'<br />';
                }
                
            }

        ?>
    </div>
    <input type="submit" class="btn btn-primary" value="Shrani"/>
</form>

<?php
    include_once "footer.php";
?>