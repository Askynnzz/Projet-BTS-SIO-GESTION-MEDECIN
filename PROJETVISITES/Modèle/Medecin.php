<?php
include_once 'db_config.php';
class Medecin
{
    private $conn;

    private $idMedecin;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Méthode pour se connecter
    public function listeMedecin()
    {
        $query = "SELECT id,nom,prenom FROM medecin";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();



        if ($stmt->rowCount() > 0) {
            $results = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return false;
        }
    }

    public function getIdMedecin()
    {
        return $this->idMedecin;
    }





    // Méthode pour se déconnecter (peut être vide dans ce cas)
    public function logout()
    {
        // Vous pouvez implémenter une logique de déconnexion ici si nécessaire
    }
}
?>