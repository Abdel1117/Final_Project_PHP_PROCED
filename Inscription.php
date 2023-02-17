<?php

// Initialisation des variables

$pseudo = $mdp = $email = $nom = $prenom = $adresse = $ville = $codePostal = '';

$pseudoErr = $mdpErr = $emailErr = $nomErr = $prenomErr = $adresseErr = $villeErr = $codePostalErr = '';

 

// Fonction de validation de champ

function validateField($field, &$fieldErr, $required = true, $regex = null, $unique = false, $minLength = null, $maxLength = null) {

    if ($required && empty($_POST[$field])) {

        $fieldErr = 'Le champ est obligatoire';

        return false;

    }

 

    if ($regex && !preg_match($regex, $_POST[$field])) {

        $fieldErr = 'Le champ n\'est pas valide';

        return false;

    }

 

    if ($unique) {

        $content = file_get_contents('users.txt');

        $users = explode("\n", $content);

        foreach ($users as $user) {

            $data = explode(',', $user);

            if ($data[0] == $_POST[$field]) {

                $fieldErr = 'Ce pseudo est déjà utilisé';

                return false;

            }

        }

    }

 

    if ($minLength && strlen($_POST[$field]) < $minLength) {

        $fieldErr = 'Le champ doit contenir au moins ' . $minLength . ' caractères';

        return false;

    }

 

    if ($maxLength && strlen($_POST[$field]) > $maxLength) {

        $fieldErr = 'Le champ ne doit pas dépasser ' . $maxLength . ' caractères';

        return false;

    }

 

    return true;

}

 

// Traitement du formulaire

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validation des champs

    $valid = true;

 

    $valid = validateField('pseudo', $pseudoErr, true, '/^[a-zA-Z0-9_]+$/', true, 4, 14) && $valid;

    $valid = validateField('mdp', $mdpErr, true) && $valid;

    $valid = validateField('email', $emailErr, true, '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/') && $valid;

    $valid = validateField('nom', $nomErr, true) && $valid;

   $valid = validateField('prenom', $prenomErr, true) && $valid;

    $valid = validateField('adresse', $adresseErr, true) && $valid;

    $valid = validateField('ville', $villeErr, true) && $valid;

    $valid = validateField('codePostal', $codePostalErr, true, '/^[0-9]{5}$/') && $valid;

 

    if ($valid) {

        // Ajout de l'utilisateur dans le fichier texte

        $pseudo = $_POST['pseudo'];

        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $email = $_POST['email'];

        $nom = $_POST['nom'];

        $prenom = $_POST['prenom'];

        $adresse = $_POST['adresse'];

        $ville = $_POST['ville'];

        $codePostal = $_POST['codePostal'];

 

        $line = "$pseudo,$mdp,$email,$nom,$prenom,$adresse,$ville,$codePostal\n";

        file_put_contents('users.txt', $line, FILE_APPEND);

 

        // Redirection vers

    // Redirection vers une page de confirmation

    header('Location: conexion.php');

   exit();
    }
} ?>
<?php include('../Final_project/View/Template/Header.php') ?>
<main class="p-4">
<form action="inscription.php" method="post" class="w-50">
<!-- Formulaire d'inscription -->
 <form method="post"> 
    <div> <label for="pseudo">Pseudo:</label> <input type="text" name="pseudo" id="pseudo" value="<?php echo htmlspecialchars($pseudo); ?>"> <?php if (!empty($pseudoErr)): ?> <span class="error"><?php echo $pseudoErr; ?></span> <?php endif; ?> </div> 
        <div> <label for="mdp">Mot de passe:</label> <input type="password" name="mdp" id="mdp"> <?php if (!empty($mdpErr)): ?> <span class="error"><?php echo $mdpErr; ?></span> <?php endif; ?> </div> 
            <div> <label for="email">Email:</label> <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"> <?php if (!empty($emailErr)): ?> <span class="error"><?php echo $emailErr; ?></span> <?php endif; ?> </div>
                 <div> <label for="nom">Nom:</label> <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($nom); ?>"> <?php if (!empty($nomErr)): ?> <span class="error"><?php echo $nomErr; ?></span> <?php endif; ?> </div> 
                    <div> <label for="prenom">Prénom:</label> <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($prenom); ?>"> <?php if (!empty($prenomErr)): ?> <span class="error"><?php echo $prenomErr; ?></span> <?php endif; ?> </div> 
                        <div> <label for="adresse">Adresse:</label> <input type="text" name="adresse" id="adresse" value="<?php echo htmlspecialchars($adresse); ?>"> <?php if (!empty($adresseErr)): ?> <span class="error"><?php echo $adresseErr; ?></span> <?php endif; ?> </div> 
                            <div> <label for="ville">Ville:</label> <input type="text" name="ville" id="ville" value="<?php echo htmlspecialchars($ville); ?>"> <?php if (!empty($villeErr)): ?> <span class="error"><?php echo $villeErr; ?></span> <?php endif; ?> </div> 
                                <div> <label for="codePostal">Code postal:</label> <input type="text" name="codePostal" id="codePostal" value="<?php echo htmlspecialchars($codePostal); ?>"> <?php if (!empty($codePostalErr)): ?> <span class="error"><?php echo $codePostalErr; ?></span> <?php endif; ?> </div>
                                     <div> <input type="submit" value="S'inscrire"> </div> </form> <!-- CSS pour afficher les erreurs en rouge --> <style> .error { color: red; } </style>

</form>
  </main>
  <?php include('../FINAL_PROJECT/View/Template/Footer.php'); ?>
  