<?php
    include_once "header.php";
    include_once "db.php";
?>
<br/>
<div class="actors">
<?php

    $query = "SELECT * FROM actors";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch()){
        echo '<div class="view-borders">';
        echo '<a href="actor.php?id='.$row['actor_id'].'">';
            echo $row['first_name'].' '.$row['last_name'];
        echo '</a>';
        echo '<br/>';
        echo '<span>'.$row['nickname'].'</span>';
        echo '<br/>';
        echo '<a href="actor_edit.php?id='.$row['actor_id'].'">Uredi</a> ';
        echo '<a href="actor_delete.php?id='.$row['actor_id'].'" onclick="return confirm(\'Prepričani?\')">Izbriši</a>';
        echo '<br/>';
        echo '</div>';
    }
?>
<a href="actor_add.php" class="btn btn-primary">Dodaj igralca</a>
</div>

<?php

    include_once "footer.php";

?>
