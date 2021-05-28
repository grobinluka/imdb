<?php 

    include_once 'session.php';
    include_once 'db.php';
    include_once 'functions.php';

    $comment_id = (int) $_GET['id'];

    $query = "SELECT * FROM comments WHERE comment_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$comment_id]);
    $result = $stmt->fetch();
    $movie_id = $result['movie_id'];

    if(canCurrentUserDeleteComment($comment_id)){
        $query = "DELETE FROM comments WHERE comment_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$comment_id]);

        msg('Komentar izbrisan!');
    }
    else{
        msg('Napaka, nimate potrebnih pravic!', 'napaka');
    }

    header("Location: movie.php?id=$movie_id#komentar-sidro"); die();

?>