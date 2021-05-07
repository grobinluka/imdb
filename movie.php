<?php
    include_once "header.php";
    include_once "db.php";

    $id = (int) $_GET['id'];

    $query = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $movie = $stmt->fetch();
?>

<div class="filmi">
    <div class="film-slike">
        <img src="https://m.media-amazon.com/images/M/MV5BYTViNzMxZjEtZGEwNy00MDNiLWIzNGQtZDY2MjQ1OWViZjFmXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg" alt="slika" />
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

<div class="igralci">
    <div class="igralec">
        <img src="https://m.media-amazon.com/images/M/MV5BMjExNzA4MDYxN15BMl5BanBnXkFtZTcwOTI1MDAxOQ@@._V1_.jpg" alt="igralec" />
        <div class="igralec-podatki">
            <div>Vin Diesel (Jože Novak)</div>
        </div>
    </div>
    <div class="igralec">
        <img src="https://m.media-amazon.com/images/M/MV5BMjExNzA4MDYxN15BMl5BanBnXkFtZTcwOTI1MDAxOQ@@._V1_.jpg" alt="igralec" />
        <div class="igralec-podatki">
            <div>Vin Diesel (Jože Novak)</div>
        </div>
    </div>
</div>

<div class="komentarji">
    <div class="komentar-form">
        <form action="comment_insert.php" method="post">
            <textarea name="content" class="form-control" placeholder="Vnesi komentar"></textarea><br />
            <input type="submit" value="Pošlji" class="btn btn-primary">
        </form>
    </div>
    <div class="komentarji-prikaz">
        <div class="komentar">
            <div class="komentar-oseba">Goraz Žižek</div>
            <div class="komentar-datum">25.4.2021 @ 13:34</div>
            <div class="komentar-opis">To je najjači film ever. Priporočam ogled.</div>
        </div>
    </div>
</div>


<?php
    include_once "footer.php";
?>