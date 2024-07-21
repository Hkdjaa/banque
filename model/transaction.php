<?php
class Transaction {
    protected $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function getTransactionsByClientId($clientId) {
        $sql = "SELECT ID_transaction, Montant FROM transactions WHERE ID_client = :clientId";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute(['clientId' => $clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
