<?php
class Client {
    private $nom_client;
    private $Prenom_client;
    private $telephone_client;
    private $adresse_client;
    private $email_client;
    private $sexe;
    private $statut;
    protected $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function getNom_client() {
        return $this->nom_client;
    }

    public function setNom_client($nom_client) {
        $this->nom_client = $nom_client;
    }

    public function getPrenom_client() {
        return $this->Prenom_client;
    }

    public function setPrenom_client($Prenom_client) {
        $this->Prenom_client = $Prenom_client;
    }

    public function getTelephone_client() {
        return $this->telephone_client;
    }

    public function setTelephone_client($telephone_client) {
        $this->telephone_client = $telephone_client;
    }
    public function getemail_client() {
        return $this->email_client;
    }

    public function setemail_client($email_client) {
        $this->Prenom_client = $email_client;
    }

    public function getadresse_client() {
        return $this->adresse_client;
    }

    public function setadresse_client($adresse_client) {
        $this->adresseclient = $adresse_client;
    }
    public function getsexe_client() {
        return $this->sexe;
    }

    public function setsexe_client($sexe) {
        $this->sexe = $sexe;
    }

    public function getstatut_client() {
        return $this->statut;
    }

    public function setstatut_client($statut) {
        $this->statut = $statut;
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Getters and setters...

    public function getMatchingClients($search) {
        $query = "SELECT client.*, comptebancaire.numero_compte, comptebancaire.solde 
                  FROM client 
                  LEFT JOIN comptebancaire ON client.ID_client = comptebancaire.client_id 
                  WHERE client.Nom_client LIKE :search OR client.Prenom_client LIKE :search OR client.email_client LIKE :search";
        $stmt = $this->connect->prepare($query);
        $stmt->execute(['search' => '%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAccountTransactions($accountNumber) {
        $query = "SELECT * FROM operationbancaire 
                  WHERE compte_source_id = :accountNumber OR compte_destination_id = :accountNumber";
        $stmt = $this->connect->prepare($query);
        $stmt->execute(['accountNumber' => $accountNumber]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
    }
?>
