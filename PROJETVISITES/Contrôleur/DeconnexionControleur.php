<?php
session_start();
include_once '../Modèle/Visiteur.php';
include_once '../Modèle/db_config.php';
$database = new Database();
$db = $database->getConnection();

$visiteur = new Visiteur($db);

if (isset($_POST['action'])) {
    $action = $_POST['action'];
  
    if ($action == 'Se deconnecter') {
        
        $visiteur->logout();
        header("Location: ../Vue/vueConnexion.php");
        exit;
    }


}
?>