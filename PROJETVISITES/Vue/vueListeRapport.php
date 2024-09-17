<?php
session_start();

// Inclure votre classe Rapport
include '../Modèle/db_config.php';
include '../Modèle/Rapport.php';


// Créer une instance de la classe Rapport avec la connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$rapport = new Rapport($db);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$idVisiteur = $_SESSION['user_id'];

// Appeler la méthode pour récupérer la liste des rapports de l'utilisateur
$listeRapports = $rapport->voirListeRapport($idVisiteur);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rapports</title>
    <style>
        .rapport-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Liste des Rapports</h2>

    <?php
    if ($listeRapports) {
        foreach ($listeRapports as $rapport) {
            echo '<a href="vueRapport.php?id=' . $rapport['id'] . '" class="rapport-box">';
            echo '<p>ID du rapport : ' . $rapport['id'] . '</p>';
            echo '<p>Date : ' . $rapport['date'] . '</p>';
            echo '<p>Motif : ' . $rapport['motif'] . '</p>';
            echo '</a>';
        }
    } else {
        echo '<p>Aucun rapport trouvé.</p>';
    }
    ?>

</body>
</html>

