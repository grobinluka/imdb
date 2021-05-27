<?php
    include_once "header.php";

    adminOnly();

    include_once "db.php";
?>
<br/>
<div class="genres">
<?php

    $query = "SELECT * FROM genres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch()){
        echo '<div class="view-borders">';
        echo $row['genre'];
        echo '<br/>';
        echo '<span>'.$row['short'].'</span>';
        echo '<br/>';
        echo '<a href="genre_edit.php?id='.$row['genre_id'].'">Uredi</a> ';
        echo '<a href="genre_delete.php?id='.$row['genre_id'].'" onclick="return confirm(\'Prepričani?\')">Izbriši</a>';
        echo '<br/>';
        echo '</div>';
    }
?>
<a href="genre_add.php" class="btn btn-primary">Dodaj žanr</a>
</div>

<?php

    include_once "footer.php";

?>