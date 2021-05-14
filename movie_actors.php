<?php

include_once "header.php";
include_once "db.php";
include_once "functions.php";

$movie_id = (int) $_GET['id'];

$movie = getMovieData($movie_id);

$query = "SELECT * FROM roles WHERE movie_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$movie_id]);

$actors = array();
while($row = $stmt->fetch()){
    $actors[] = $row['actor_id'];
}


?>

<h1><?php echo $movie['title'].' ('.$movie['release_year'].')'; ?></h1>

<form action="roles_insert.php" method="post">
    <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>" />
    <?php 
    
        $query = "SELECT * FROM actors";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while($row = $stmt->fetch()){
            if(in_array($row['actor_id'], $actors)){
                echo '<input type="checkbox" checked="checked" name="actors[]" value="'.$row['actor_id'].'"/> '.$row['first_name'].' '.$row['last_name'].'<br />';
                echo '<input type="text" value="Vnesi ime vloge" name="role['.$row['actor_id'].']" class="form-control" /><br />';
            }
            else{
                echo '<input type="checkbox" name="actors[]" value="'.$row['actor_id'].'"/> '.$row['first_name'].' '.$row['last_name'].'<br />';
                echo '<input type="text" placeholder="Vnesi ime vloge" name="role['.$row['actor_id'].']" class="form-control" /><br />';
            }
            echo '<hr />';
        }
    ?>
    <input type="submit" value="Shrani" class="btn btn-primary" />
</form>

<?php 

    include_once "footer.php";

?>