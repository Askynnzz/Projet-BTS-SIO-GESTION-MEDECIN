<?php
session_start();

// Inclure votre classe Rapport
include '../Modèle/db_config.php';
include '../Modèle/Rapport.php';

// Créer une instance de la classe Rapport avec la connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$rapport = new Rapport($db);

// Vérifier si l'ID du rapport a été envoyé en POST
if (isset($_POST['idRapport'])) {
    $idRapport = $_POST['idRapport'];
    
    // Supprimer le rapport
    if ($rapport->supprimerRapport($idRapport)) {
        // Rediriger vers la liste des rapports avec un message de succès
        $_SESSION['message'] = "Le rapport a été supprimé avec succès.";
        header("Location: ../Vue/vueListeRapport.php");
        exit();
    } else {
        // Rediriger vers la page de modification avec un message d'erreur
        $_SESSION['error'] = "Erreur lors de la suppression du rapport.";
        header("Location: ../Vue/vueRapport.php?id=$idRapport");
        exit();
    }
} else {
    // Rediriger vers la liste des rapports si l'ID du rapport n'a pas été spécifié
    header("Location: voirListeRapports.php");
    exit();
}

?>
