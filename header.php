<?php 

  include_once "session.php";
  include_once "functions.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Boljše kot IMDB</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <img src="assets/img/logo.png" alt="imdb_logo.png" width="60px"/>
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">Large</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="text-muted" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
            </a>
            <?php 
            
              if(!isset($_SESSION['user_id'])){
                echo '<a class="btn btn-sm btn-outline-secondary" href="user_add.php">Registracija</a>';
                echo '<a class="btn btn-sm btn-outline-secondary" href="login.php">Prijava</a>';
              }
              else{
                //echo '<div>'.getUserName($_SESSION['user_id']).'&nbsp;</div>';
                echo '<a class="btn btn-sm btn-outline-secondary" href="logout.php">Odjava</a>';
              }

            ?>
            
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex">
          <?php
            if(isAdmin()){
              echo '<a class="p-2 text-muted" href="genres.php">Žanri</a>';
            }

            if(isset($_SESSION['user_id'])){
              echo '<a class="p-2 text-muted" href="actors.php">Igralci</a>';
              echo '<a class="p-2 text-muted" href="movies.php">Filmi</a>';
            }
          ?>
        </nav>
      </div>

      
    </div>

    <main role="main" class="container">
        <div class="sporocila">
          <?php
          
            if(isset($_SESSION['msg'])){
              echo '<span class="'.$_SESSION['msg_type'].'">'.$_SESSION['msg'].'</span>';

              //brisanje sporočila
              unset($_SESSION['msg']);
            }

          ?>
        </div>
      <div class="row">
        <div class="col-md-8 blog-main">
          