
<?php



if (isset($_POST['connexion'])) {


    $pseudo = trim($_POST['pseudo']);

    $mdp = $_POST['mdp'];


    $inscriptions = file_get_contents('users.txt');


    $ligne = false;

    foreach (explode("\n", $inscriptions) as $l) {

        if (strpos($l, $pseudo.',') === 0) {

            $ligne = $l;
            break;

        }

    }


    if ($ligne) {

        $hash = substr($ligne, strlen($pseudo) +1 );

        $mot_de_passe = explode(",",$hash);

        if (password_verify($mdp, $mot_de_passe[0])) {
          

            $infos = explode(',', $ligne);
            
            $user = [

                'pseudo' => $pseudo,

                'nom' => $infos[2],

                'prenom' => $infos[3],

                'email' => $infos[4],

                'adresse' => $infos[5],

                'ville' => $infos[6],

                'code_postal' => $infos[7],

            ];
            session_start();
            $_SESSION['user'] = $user;
            header('Location: profil.php');

        } else {
            $erreur = 'Mot de passe incorrect';
        }

    } else {
        
        $erreur = 'Pseudo non enregistré';

    }

}

?>


  <header>
  <?php include('../FINAL_PROJECT/View/Template/Header.php'); ?>

    </header>
  <main>
  <h1>Accueil</h1>
 

<?php if (isset($erreur)): ?>

    <p><?php echo $erreur; ?></p>

<?php endif; ?>


<main class="container ">
<form method="post" >

    <div>

        <label class="form-label" for="pseudo">Pseudo :</label>

        <input class="form-control" type="text" id="pseudo" name="pseudo" required>

    </div>

    <div>

        <label class="form-label" for="mdp">Mot de passe :</label>

        <input class="form-control" type="password" id="mdp" name="mdp" required>

    </div>

    <button type="submit" name="connexion">Se connecter</button>

</form>

</body>



  </main>
  <?php include('../FINAL_PROJECT/View/Template/Footer.php'); ?>
