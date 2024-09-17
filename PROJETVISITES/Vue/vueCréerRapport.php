<?php
session_start(); // Ajoutez cette ligne pour initialiser la session

// Reste du code...
?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulaire de Rapport de Visite</title>
</head>

<body>
    <h1>Formulaire de Rapport de Visite</h1>
    <?php
    // Assurez-vous que la session est démarrée
    

    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        // Récupérez l'ID de l'utilisateur connecté
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        echo '<div>Bonjour, ' . $user_name;
        echo '<form method ="post" action="../Contrôleur/VisiteurControleur.php?action=deconnexion">
			<button type="submit">Déconnexion</button>
		    </form>';
    } else {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
        header("Location: ../vueConnexion.php");
        exit();
    }
    ?>
    <form method="post" action="../Contrôleur/RapportControleur.php?action=creationrapport  ">
        <!-- Sélectionner un médecin -->

        <select name="medecin">


            <?php
            include '../Modèle/Medecin.php';
            $database = new Database();
            $db = $database->getConnection();
            $medecin = new Medecin($db);

            $listeMedecins = $medecin->listeMedecin();


            if ($listeMedecins) {
                foreach ($listeMedecins as $medecin) {
                    echo '<option value="' . $medecin['id'] . '">' . $medecin['nom'] . ' ' . $medecin['prenom'] . '</option>';
                }
            } else {
                echo '<option value="">Aucun médecin trouvé</option>';
            }
            ?>
        </select>


        <label for="date">Date :</label>
        <input type="date" name="date" id="date" required>

        <label for="motif">Motif de la visite :</label>
        <input type="text" name="motif" id="motif" required>

        <label for="bilan">Bilan de la visite :</label>
        <textarea name="bilan" id="bilan" rows="4" required></textarea>

        <label for="medicament">Médicaments :</label>
        <input type="text" name="medicament" id="medicament" required>

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" required>
        <input type="submit" name="action" value="CreerRapport">
        
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" name="idMedecin" value="<?php echo $medecin['id']; ?>">

       



    </form>

</body>


</html>