
<?php session_start();
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
<?php


 

// Fonction pour vérifier si l'utilisateur est connecté



// Vérifier si le formulaire de connexion a été soumis

if (isset($_POST['connexion'])) {

    // Récupérer le pseudo et le mot de passe saisis dans le formulaire

    $pseudo = trim($_POST['pseudo']);

    $mdp = $_POST['mdp'];

    

    // Lire le fichier d'inscriptions

    $inscriptions = file_get_contents('users.txt');

 

    // Chercher la ligne correspondant au pseudo saisi

    $ligne = false;

    foreach (explode("\n", $inscriptions) as $l) {

        if (strpos($l, $pseudo.',') === 0) {

            $ligne = $l;
            break;

        }

    }

 

    if ($ligne) {

        // Extraire le hash du mot de passe enregistré
        $hash = substr($ligne, strlen($pseudo) +1 );

        $mot_de_passe = explode(",",$hash);
        var_dump($mot_de_passe[0]);
        // Vérifier si le mot de passe saisi correspond au hash enregistré

        if (password_verify($mdp, $mot_de_passe[0])) {

            // Le mot de passe est correct, on stocke les infos de l'utilisateur dans la session

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

            $_SESSION['user'] = $user;

 

            // Rediriger vers la page profil

            header('Location: profil.php');

            exit();

        } else {
            $erreur = 'Mot de passe incorrect';
        }

    } else {
        
        $erreur = 'Pseudo non enregistré';

    }

}

?>


<body>
  <header>
            <?php     include('../Projet_final/View/Template/Header.php');
 ?>
    </header>
  <main>
  <h1>Accueil</h1>

 

<?php if (isset($erreur)): ?>

    <p><?php echo $erreur; ?></p>

<?php endif; ?>



<form method="post" >

    <div>

        <label for="pseudo">Pseudo :</label>

        <input type="text" id="pseudo" name="pseudo" required>

    </div>

    <div>

        <label for="mdp">Mot de passe :</label>

        <input type="password" id="mdp" name="mdp" required>

    </div>

    <button type="submit" name="connexion">Se connecter</button>

</form>

</body>

</html>


  </main>
  <footer>
        <?php     include('../Projet_final/View/Template/Footer.php');
 ; ?>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>