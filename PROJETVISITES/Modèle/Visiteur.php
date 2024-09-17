<?php
include_once 'db_config.php';
class Visiteur
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Méthode pour créer un compte visiteur
    public function createVisiteur($nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmbauche)
    {
        try {
            $query = "INSERT INTO visiteur (nom, prenom, login, mdp, adresse, cp, ville, dateEmbauche) VALUES (:nom, :prenom, :login, :mdp, :adresse, :cp, :ville, :dateEmbauche)";
            $stmt = $this->conn->prepare($query);
    
            // Hacher le mot de passe avant de l'insérer dans la base de données
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":mdp", $hashedPassword); // Utiliser le mot de passe haché
            $stmt->bindParam(":adresse", $adresse);
            $stmt->bindParam(":cp", $cp);
            $stmt->bindParam(":ville", $ville);
            $stmt->bindParam(":dateEmbauche", $dateEmbauche);
    
            if ($stmt->execute()) {
                return true; // Compte créé avec succès
            } else {
                return false; // Erreur lors de la création du compte
            }
        } catch (PDOException $e) {
            // Afficher l'erreur
            echo "Erreur lors de la création du visiteur : " . $e->getMessage();
            return false;
        }
    }
    


    // Méthode pour se connecter
    public function login($login, $mdp)
    {
        $query = "SELECT id, nom, mdp, typeVisiteur FROM visiteur WHERE login = :login";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":login", $login);
    
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row['mdp'];
    
            // Vérifier le mot de passe haché
            if (password_verify($mdp, $hashedPassword)) {
                // Démarrer la session
                session_start();
    
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nom'];
                $_SESSION['typeVisiteur'] = $row['typeVisiteur'];
    
                if ($_SESSION['typeVisiteur'] === 1) {
                    header("Location: ../Vue/vuePharmacien.php");
                    exit;
                } else {
                    header("Location: ../Vue/vueAccueil.php");
                    exit;
                }
            } else {
                return false; // Mot de passe incorrect
            }
        } else {
            return false; // Identifiant incorrect
        }
    }
    




    public function logout() {
        // Démarrer la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Détruire toutes les données de session
        session_unset();
        
        // Détruire la session
        session_destroy();
    }
}
?>