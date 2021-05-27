<?php
    include_once "header.php";
    include_once "db.php";
    include_once "functions.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $movie = $stmt->fetch();
?>

<div class="filmi">
    <div class="film-slike">
        <img src="https://images-na.ssl-images-amazon.com/images/I/7124A8OOL6L._AC_SL1001_.jpg" alt="slika" /><br />
        <form action="movie_image_upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $movie['movie_id'];?>" /><br />
            <input type="text" name="title" placeholder="Vnesi naslov slike" class="form-control" /><br />
            <select name="type" class="form-control">
                <option value="img">Slika</option>
                <option value="video">Video</option>
            </select><br />
            <input type="file" name="file" placeholder="Naloži sliko filma" class="form-control" /><br />
            <input type="submit" value="Naloži" />
        </form>
    </div>
    <div class="film-podatki">
        <div class="naslov"><?php echo $movie['title']; ?></div>
        <div class="zanri"><?php echo getGenres($movie['movie_id']); ?></div>
        <div class="dolzina"><?php echo fromDateToString($movie['duration']); ?></div>
        <div class="leto"> <?php echo $movie['release_year']; ?></div>
        <div class="ocena">* * * * *</div>
        <div class="opis"><?php echo $movie['description']; ?></div>
    </div>
</div>

<h2>Igralska zasedba</h2></br>
<a href="movie_actors.php?id=<?php echo $id; ?>" class="btn btn-primary"> Igralci v tem filmu</a>
</br>
</br>

<div class="igralci">
    <div class="igralec">
        <table>
            <?php
                $query = "SELECT a.actor_id, a.first_name, a.last_name, r.role FROM roles r INNER JOIN actors a ON a.actor_id = r.actor_id WHERE (r.movie_id = ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$id]);

                while($row = $stmt->fetch()){

            ?>
            <tr>
                <td><img src="<?php echo getActorAvatar($row['actor_id']); ?>" alt="igralec" /></td>
                <td>
                    <div class="igralec-podatki"><?php echo $row['first_name'].' '.$row['last_name']; ?></div>
                </td>
                <td>
                    <div class="igralec-film-podatki">
                        <div><?php echo $row['role']; ?></div>
                    </div>
                </td>
            </tr>
            <?php 
                }
            ?>
            <!--<tr>
                <br />
                <td><a href="#">Prikaži vse igralce</a></td>
            </tr>-->
        </table>
    </div>
</div>

<br />
<hr /><br />
<h2>Komentarji</h2></br>
<div class="komentarji">
    <form action="movie_comment_insert.php" method="post">
        <input type="hidden" name="id" value="<?php echo $movie['movie_id']; ?>" />
        <textarea name="content" class="form-control" placeholder="Vnesi komentar"></textarea><br />
        <input type="submit" value="Objavi" class="btn btn-primary" />
    </form>

    <div class="komentarji-prikaz" id="komentar-sidro">
    <?php
        $query = "SELECT * FROM comments WHERE movie_id = ? ORDER BY date_add DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        while($row = $stmt->fetch()){

    ?>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card post">
                        <div class="post-heading">
                            <div class="float-left image">
                                <img src="<?php echo getUserAvatar($row['user_id']); ?>" alt="actor_image" class="avatar"/>
                            </div>
                            <div class="float-left meta">
                                <div class="title h5"><?php echo getUserName($row['user_id']); ?></div>
                                <div class="text-muted time date-font-size"><?php echo getSloDateTime($row['date_add']);?></div>
                            </div>
                        </div>
                        <div class="post-description"><?php echo $row['content'];?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>

    </div>
</div>

<?php
    include_once "footer.php";
?>