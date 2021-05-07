<?php
    include_once "header.php";
    include_once "db.php";
?>

<br/>
<div class="movies">
<?php

    $query = "SELECT * FROM movies";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch()){
        echo '<div class="view-borders">';
        echo '<a href="movie.php?id='.$row['movie_id'].'">';
            echo $row['title'];
        echo '</a>';
        echo '<br/>';
        echo '<span>'.$row['release_year'].'</span>';
        echo '<br/>';
        echo '<a href="movie_edit.php?id='.$row['movie_id'].'">Uredi</a> ';
        echo '<a href="movie_delete.php?id='.$row['movie_id'].'" onclick="return confirm(\'Prepričani?\')">Izbriši</a>';
        echo '<br/>';
        echo '</div>';
    }
?>
</div>
<a href="movie_add.php" class="btn btn-primary">Dodaj film</a>


<?php

    include_once "footer.php";

?>
