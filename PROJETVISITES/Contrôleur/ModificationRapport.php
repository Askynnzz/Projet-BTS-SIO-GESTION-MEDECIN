<?php
session_start();
include_once '../Modèle/Rapport.php';
include_once '../Modèle/db_config.php';
$database = new Database();
$db = $database->getConnection();
$rapport = new Rapport($db);



 
        $date = $_POST['date'];
        $motif = $_POST['motif'];
        $bilan = $_POST['bilan'];
        $idRapport = $_POST['idRapport'];


        
        if ($rapport->UpdateRapportVisiteur($date, $motif, $bilan, $idRapport)) {
            // mise a jour effectuée
           
            exit;

        } else {
            echo "Erreur lors de la mise a jour des données du rapport";
        }
        
  
?>


