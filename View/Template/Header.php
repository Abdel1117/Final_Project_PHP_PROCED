    <nav class="nav justify-content-center  ">
  <a class="nav-link" href="index.php" aria-current="page">Accueil</a>
  
  <?php if(isset($_SESSION['user'])) : ?>
        <a class="nav-link" href="profil.php">Profil</a>
        <a class="nav-link" href="deconexion.php">Deconnexion</a>
    <?php else : ?>
        <a class="nav-link" href="conexion.php">Connexion</a>
        <a class="nav-link" href="inscription.php">Inscription</a>
    <?php endif ?>

</nav>