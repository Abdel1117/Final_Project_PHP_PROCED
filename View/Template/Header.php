<?php
if(!isset($_SESSION)){

  session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<nav class="nav justify-content-center  ">
  
  
  <?php if(isset($_SESSION['user'])) : ?>
        <a class="nav-link" href="index.php" aria-current="page">Accueil</a>    
        <a class="nav-link" href="profil.php">Profil</a>
        <a class="nav-link" href="gestion_articles.php">Crée des articles</a>
        <a class="nav-link" href="deconexion.php">Deconnexion</a>
    <?php else : ?>
        <a class="nav-link" href="index.php" aria-current="page">Accueil</a>    
        <a class="nav-link" href="conexion.php">Connexion</a>
        <a class="nav-link" href="inscription.php">Inscription</a>
    <?php endif ?>
</nav>
<body>