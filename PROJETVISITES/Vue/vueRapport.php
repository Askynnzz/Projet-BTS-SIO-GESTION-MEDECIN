<?php
session_start();

// Inclure votre classe Rapport
include '../Modèle/db_config.php';
include '../Modèle/Rapport.php';

// Créer une instance de la classe Rapport avec la connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$rapport = new Rapport($db);

// Récupérer l'ID du rapport à afficher
if (isset($_GET['id'])) {
    $idRapport = $_GET['id'];
    
    // Récupérer les détails du rapport
    $detailsRapport = $rapport->getDetailsRapport($idRapport);
    
    // Si les détails du rapport existent
    if ($detailsRapport) {
?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Détails du rapport</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    padding: 20px;
                }
                
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                
                h3 {
                    color: #333;
                    margin-top: 20px;
                }
                
                .details p {
                    margin-bottom: 15px;
                    font-size: 16px;
                    color: #555;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Détails du rapport</h2>
                <div class="details">
                    <p><strong>ID du rapport:</strong> <?php echo $detailsRapport['id']; ?></p>
                    <p><strong>Date du rapport:</strong> <?php echo $detailsRapport['date']; ?></p>
                    <p><strong>Motif:</strong> <?php echo $detailsRapport['motif']; ?></p>
                    <p><strong>Bilan:</strong> <?php echo $detailsRapport['bilan']; ?></p>
                    
                    <!-- Ajoutez d'autres détails du rapport ici si nécessaire -->
                </div>
                <a href="vueModificationRapport.php?id=<?php echo $idRapport; ?>" class="edit-link">Modifier ce rapport</a>
            </div>
            <form method="post" action="../Contrôleur/SupprimerRapportControleur.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">
                <input type="hidden" name="idRapport" value="<?php echo $idRapport; ?>">
                <input type="submit" value="Supprimer le rapport" style="background-color: red; color: white;">
            </form>
        </body>
        </html>
<?php
    } else {
        echo "Aucun détail trouvé pour ce rapport.";
    }
} else {
    // Rediriger ou afficher un message d'erreur si l'ID du rapport n'est pas spécifié
    header("Location: voirListeRapports.php");
    exit();
}
?>
