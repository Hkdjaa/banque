<?php
include 'comptebancaire.php';

class OperationBancaire {
    private $id;
    private $type;
    private $montant;
    private $date;
    private $compte_source_id;
    private $compte_destination_id;
    private $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    // Getters and Setters

    // Method to deposit money
    
        public function effectuerDepot($idCompte, $montant) {
            try {
                $this->connect->beginTransaction();
    
                // Mettre à jour le solde du compte
                $stmt = $this->connect->prepare("UPDATE comptebancaire SET solde = solde + ? WHERE id = ?");
                $stmt->execute([$montant, $idCompte]);
    
                // Insérer l'opération dans la table operationbancaire
                $stmt = $this->connect->prepare("INSERT INTO operationbancaire (type, montant, date, compte_source_id) VALUES (?, ?, NOW(), ?)");
                $stmt->execute(['depot', $montant, $idCompte]);
    
                $this->connect->commit();
    
                return "Dépôt effectué avec succès !";
            } catch (Exception $e) {
                $this->connect->rollBack();
                return "Erreur lors du dépôt : " . $e->getMessage();
            }
        }
    

    // Method to withdraw money
    public function effectuerRetrait($compte_source_id, $montant) {
        $this->type = 'retrait';
        $this->montant = $montant;
        $this->date = date('Y-m-d H:i:s');
        $this->compte_source_id = $compte_source_id;

        try {
            $sql = "INSERT INTO operationbancaire (type, montant, date, compte_source_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->connect->prepare($sql);

            if ($stmt->execute([$this->type, $this->montant, $this->date, $this->compte_source_id])) {
                return "Retrait effectué avec succès !";
            } else {
                return "Erreur lors du retrait : " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    // Method to transfer money
    public function effectuerVirement($compte_source_id, $compte_destination_id, $montant) {
        $this->type = 'virement';
        $this->montant = $montant;
        $this->date = date('Y-m-d H:i:s');
        $this->compte_source_id = $compte_source_id;
        $this->compte_destination_id = $compte_destination_id;

        try {
            $sql = "INSERT INTO operationbancaire (type, montant, date, compte_source_id, compte_destination_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connect->prepare($sql);

            if ($stmt->execute([$this->type, $this->montant, $this->date, $this->compte_source_id, $this->compte_destination_id])) {
                return "Virement effectué avec succès !";
            } else {
                return "Erreur lors du virement : " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
}
?>
