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
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <?php 
                $query = "SELECT * FROM multimedia WHERE movie_id = ? AND type='img'";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$id]);
                $numImages = $stmt->rowCount(); //število slik, v bazi za ta film

                for($i = 0; $i < $numImages; $i++) {
                    if ($i == 0) {
                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="active"></li>';
                    }
                    else {
                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
                    }
                }
            ?>
                
            </ol>
            <div class="carousel-inner">
            <?php
                $i=0;
                while ($row = $stmt->fetch()) {
                    if ($i == 0) {
                        echo '<div class="carousel-item active">';
                    }
                    else {
                        echo '<div class="carousel-item">';
                    }                
                    echo '<img class="d-block w-100" src="'.$row['url'].'" alt="First slide">';
                    echo '<div class="carousel-caption d-none d-md-block">';
                    echo '<p>'.$row['title'].'</p>';
                    echo '</div>';
                    echo '</div>';
                    $i++;
                }
            ?>
                
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php 
            if(isAdmin()){
        ?>
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
        <?php 
            }
        ?>
    </div>
    <div class="film-podatki">
        <div class="naslov"><?php echo $movie['title']; ?></div>
        <div class="zanri"><?php echo getGenres($movie['movie_id']); ?></div>
        <div class="dolzina"><?php echo fromDateToString($movie['duration']); ?></div>
        <div class="leto"> <?php echo $movie['release_year']; ?></div>
        <div class="ocena">
            Ocena: <span><?php echo getMovieRate($movie['movie_id']) ?></span>

            <?php if(canUserRateMovie($_SESSION['user_id'], $id)){ ?>
            
            <div class="stars">
                <form action="movie_rate.php" method="post">
                    <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id'];?>" />
                    <input class="star star-5" id="star-5" type="radio" name="star" value="5"/> 
                    <label class="star star-5" for="star-5"></label> 
                    <input class="star star-4" id="star-4" type="radio" name="star" value="4" /> 
                    <label class="star star-4" for="star-4"></label> 
                    <input class="star star-3" id="star-3" type="radio" name="star" value="3" /> 
                    <label class="star star-3" for="star-3"></label> 
                    <input class="star star-2" id="star-2" type="radio" name="star" value="2" /> 
                    <label class="star star-2" for="star-2"></label> 
                    <input class="star star-1" id="star-1" type="radio" name="star" value="1" /> 
                    <label class="star star-1" for="star-1"></label> 
                    <input type="submit" value="Glasuj" class="btn"/>
                </form>
            </div>
            <?php } ?>
        </div>
        <br />
        <div class="opis"><?php echo $movie['description']; ?></div>
    </div>
</div>

<?php 
    if(isAdmin()){
?>

<h2>Igralska zasedba</h2></br>
<a href="movie_actors.php?id=<?php echo $id; ?>" class="btn btn-primary"> Igralci v tem filmu</a>
</br>
</br>

<?php 
    }
?>

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
                        <?php 
                            if(canCurrentUserDeleteComment($row['comment_id'])){
                                echo '<div class="brisanje_komentarja">';
                                echo '<a href="comment_delete.php?id='.$row['comment_id'].'" onclick="return confirm (\Prepričani?\)" class="btn btn-danger btn-delete-comment">x</a>';
                                echo '</div>';
                            }
                        ?>
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