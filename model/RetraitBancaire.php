<?php
class RetraitBancaire {
    private $numero_compte;
    private $montant;
    private $connect;

    public function __construct($connect, $numero_compte, $montant) {
        $this->connect = $connect;
        $this->numero_compte = $numero_compte;
        $this->montant = $montant;
    }

    public function effectuerRetrait() {
        try {
            $this->connect->beginTransaction();

            // Vérifier si le solde est suffisant
            $stmt = $this->connect->prepare("SELECT solde FROM comptebancaire WHERE numero_compte = ?");
            $stmt->execute([$this->numero_compte]);
            $soldeActuel = $stmt->fetchColumn();

            if ($soldeActuel === false || $soldeActuel < $this->montant) {
                $this->connect->rollBack();
                return "Solde insuffisant.";
            }

            // Mettre à jour le solde
            $stmt = $this->connect->prepare("UPDATE comptebancaire SET solde = solde - ? WHERE numero_compte = ?");
            $stmt->execute([$this->montant, $this->numero_compte]);

            // Insérer l'opération dans la table operationbancaire
            $stmt = $this->connect->prepare("INSERT INTO operationbancaire (type, montant, date, compte_source_id) VALUES (?, ?, NOW(), ?)");
            $stmt->execute(['retrait', $this->montant, $this->numero_compte]);

            $this->connect->commit();

            return "Retrait effectué avec succès !";
        } catch (Exception $e) {
            $this->connect->rollBack();
            return "Erreur lors du retrait : " . $e->getMessage();
        }
    }
}
?>
