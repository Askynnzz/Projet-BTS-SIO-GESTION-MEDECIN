<?php
session_start();

// Inclure votre classe Rapport
include '../Modèle/db_config.php';
include '../Modèle/Medicament.php';


// Créer une instance de la classe Rapport avec la connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$medicament = new Medicament($db);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$idPharmacien = $_SESSION['user_id'];

// Appeler la méthode pour récupérer la liste des rapports de l'utilisateur
$listeMedicaments = $medicament->voirListeMedicaments();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de mes médicaments</title>
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

    <h2>Liste des médicaments</h2>

    <?php
    if ($listeMedicaments) {
        foreach ($listeMedicaments as $medicament) {
            echo '<p>ID du médicament : ' . $medicament['id'] . '</p>';
            echo '<p>Date : ' . $medicament['date_creation'] . '</p>';
            echo '<p>Nom Commercial : ' . $medicament['nomCommercial'] . '</p>';
            echo '<p>Composition : ' . $medicament['composition'] . '</p>';
            echo '<p>Effets : ' . $medicament['effets'] . '</p>';
            echo '<p>Contre indications : ' . $medicament['contreIndications'] . '</p>';
            echo '</a>';
        }
    } else {
        echo '<p>Aucun médicament trouvé.</p>';
    }
    ?>

</body>
</html>

