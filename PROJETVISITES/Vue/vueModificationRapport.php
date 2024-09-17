<?php
session_start();

// Inclure votre classe Rapport
include '../Modèle/db_config.php';
include '../Modèle/Rapport.php';

// Créer une instance de la classe Rapport avec la connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$rapport = new Rapport($db);

// Récupérer l'ID du rapport à modifier
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
            <title>Modifier le rapport</title>
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
                
                .form-group {
                    margin-bottom: 20px;
                }
                
                label {
                    display: block;
                    margin-bottom: 8px;
                    color: #555;
                }
                
                input[type="text"],
                textarea {
                    width: 100%;
                    padding: 10px;
                    border-radius: 4px;
                    border: 1px solid #ccc;
                }
                
                input[type="submit"] {
                    background-color: #007BFF;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                    padding: 12px 20px;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Modifier le rapport</h2>
                <form method="post" action="../Contrôleur/ModificationRapport.php">
                    <div class="form-group">
                        <label for="date_rapport">Date du rapport:</label>
                        <input type="text" id="date_rapport" name="date" value="<?php echo $detailsRapport['date']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">motif:</label>
                        <textarea id="description" name="bilan" rows="4"><?php echo $detailsRapport['motif']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">bilan:</label>
                        <textarea id="description" name="motif" rows="4"><?php echo $detailsRapport['bilan']; ?></textarea>
                    </div>
                    
                    <!-- Ajoutez d'autres champs ici si nécessaire -->
                    
                    <input type="hidden" name="idRapport" value="<?php echo $idRapport; ?>">
                    <input type="submit" value="Mettre à jour">
                </form>
            </div>

            
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
