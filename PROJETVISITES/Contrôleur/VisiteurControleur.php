<?php
session_start();
include_once '../Modèle/Visiteur.php';
include_once '../Modèle/Pharmacien.php';
include_once '../Modèle/db_config.php';
$database = new Database();
$db = $database->getConnection();

$visiteur = new Visiteur($db);
$pharmacien = new Pharmacien($db);

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'S\'inscrire') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $dateEmbauche = $_POST['dateEmbauche'];

        if ($visiteur->createVisiteur($nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmbauche)) {
            echo "Compte créé avec succès.";
        } else {
            echo "Erreur lors de la création du compte.";
        }
    }




    if ($action == 'Se connecter') {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        
        
        if ($visiteur->login($login, $mdp)) {
             // Connexion réussie
            exit;

        }   elseif ($pharmacien->login($login, $mdp)) {
            // Connexion réussie
            header("Location: ../Vue/vuePharmacien.php");
            exit;
        }
        
        
        
        else {
            echo "Erreur lors de la connexion.";
        }
    }






}
?>