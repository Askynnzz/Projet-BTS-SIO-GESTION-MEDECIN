<?php
include_once 'db_config.php';
class Pharmacien
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

 

    // Méthode pour se connecter

    public function login($login, $mdp)
    {
        $query = "SELECT * FROM pharmacien WHERE login = :login AND mdp = :mdp";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":mdp", $mdp);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Démarrer la session
            session_start();

            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['user_id'] = $row['idPhar'];
            $_SESSION['user_name'] = $row['nom']; // Ajoutez d'autres informations utilisateur si nécessaire

            return $row['idPhar'];
            header("Location: ../Vue/vuePharmacien.php");
        } else {
            return false; // Identifiants incorrects
        }
    }




    // Méthode pour se déconnecter (peut être vide dans ce cas)
    public function logout()
    {
        // Vous pouvez implémenter une logique de déconnexion ici si nécessaire
    }
}
?>