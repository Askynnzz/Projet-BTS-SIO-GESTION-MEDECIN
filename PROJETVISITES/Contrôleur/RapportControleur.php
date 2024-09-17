<?php
include_once '../Modèle/Rapport.php';
include_once '../Modèle/db_config.php';
$database = new Database();
$db = $database->getConnection();

$rapport = new Rapport($db);

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    echo $action;

    if ($action == 'CreerRapport') {

        $date = $_POST['date'];
        $motif = $_POST['motif'];
        $bilan = $_POST['bilan'];
        $medicament = $_POST['medicament'];
        $quantite = $_POST['quantite'];
        $user_id = $_POST['user_id'];
        $idMedecin = $_POST['idMedecin'];
        




        if ($rapport->insererRapport($date, $motif, $bilan, $user_id, $idMedecin)) {
            echo "Rapport créer avec succès.";
        } 

        
    }





}
?>