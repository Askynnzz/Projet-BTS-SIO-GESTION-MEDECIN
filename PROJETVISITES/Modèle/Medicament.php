<?php
include_once 'db_config.php';

class Medicament
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function voirListeMedicaments() {
        $sql = "SELECT id, nomCommercial, idFamille, composition, effets, contreIndications, date_creation FROM medicament
        WHERE date_creation > DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
    
        // Récupérer les résultats de la requête
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultats;
    }   

    
}


