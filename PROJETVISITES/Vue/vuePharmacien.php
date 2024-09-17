<?php
session_start(); // Ajoutez cette ligne pour initialiser la session

// Reste du code...
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>
    <h1>Accueil</h1>
    <form method="post" action="../Contrôleur/DeconnexionControleur.php?action=deconnexion">
    <input type="submit" name="action" value="Se deconnecter">
    </form>
    <?php



    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $user_name = $_SESSION['user_name'];
        echo '<div>Bonjour,pharmacien ' . $user_name;
        echo '</br><a href="vueListeMedicament.php">Voir mes médicaments</a>';

    } else {
        // Si l'utilisateur n'est pas connecté, affichez les liens de connexion et d'inscription
        echo '<a href="vueInscription.php">Inscription</a>';
        echo '<a href="vueConnexion.php">Connexion</a>';
    }
    ?>



</body>

</html>