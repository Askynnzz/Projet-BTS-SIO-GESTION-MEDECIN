<?php
include_once 'db_config.php';

class Rapport
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insererRapport($date, $motif, $bilan, $idVisiteur, $idMedecin)
    {
        $sql = "INSERT INTO rapport (date, motif, bilan, idVisiteur, idMedecin) VALUES (:date, :motif, :bilan, :idVisiteur, :idMedecin)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':motif', $motif);
        $stmt->bindParam(':bilan', $bilan);
        $stmt->bindParam(':idVisiteur', $idVisiteur);
        $stmt->bindParam(':idMedecin', $idMedecin);
        $stmt->execute();
    }

    public function voirListeRapport($idVisiteur) {
        $sql = "SELECT id, date, motif FROM rapport WHERE idVisiteur = :idVisiteur";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idVisiteur', $idVisiteur);
        $stmt->execute();
    
        // Récupérer les résultats de la requête
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultats;
    }

    public function getDetailsRapport($idRapport) {
        $sql = "SELECT * FROM rapport WHERE id = :idRapport";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idRapport', $idRapport);
        $stmt->execute();

        // Récupérer les détails du rapport
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function UpdateRapportVisiteur($date, $bilan, $motif, $idRapport) {
        // Requête SQL pour mettre à jour les informations de l'appartement
        $query = "UPDATE rapport SET date = :date, motif = :motif, bilan = :bilan WHERE id = :idRapport";
        echo $etage;
        // Préparation de la requête
        $stmt = $this->conn->prepare($query);
    
        // Liaison des paramètres
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':bilan', $bilan);
        $stmt->bindParam(':motif', $motif);
        $stmt->bindParam(':idRapport', $idRapport);
        
        
        // Exécution de la requête
        if ($stmt->execute()) {
            
            header("Location:../Vue/vueRapport.php?id=$idRapport");
            echo $idRapport;
            
        } else {
            return false; // Échec de la mise à jour
        }
    }


    public function supprimerRapport($idRapport) {
        // Requête SQL pour supprimer le rapport par son ID
        $sql = "DELETE FROM rapport WHERE id = :idRapport";
        
        // Préparation de la requête
        $stmt = $this->conn->prepare($sql);
        
        // Liaison du paramètre
        $stmt->bindParam(':idRapport', $idRapport, PDO::PARAM_INT);
        
        // Exécution de la requête
        if ($stmt->execute()) {
            // Si la requête s'exécute avec succès
            return true;
        } else {
            // Si la requête échoue
            return false;
        }
    }
    
    
}


