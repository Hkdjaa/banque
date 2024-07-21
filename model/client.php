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
        $search = trim($search);
        
        // Adapter la requête pour récupérer toutes les informations du propriétaire du compte
        $sql = "SELECT c.id, c.nom_client, c.prenom_client, c.telephone_client, c.email_client, 
                c.adresse_client, c.sexe, c.statut, cb.numero_compte, cb.solde 
                FROM comptebancaire cb 
                JOIN clients c ON cb.client_id = c.id 
                WHERE cb.numero_compte LIKE :search OR c.nom_client LIKE :search";
        $stmt = $this->connect->prepare($sql);

        
        // Fetch results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAccountTransactions($accountNumber) {
        $accountNumber = trim($accountNumber);
        
        // Préparer la requête SQL
        $sql = "SELECT * FROM transactions WHERE numero_compte = :accountNumber";
        $stmt = $this->connect->prepare($sql);
        
        // Bind parameter and execute query
        $stmt->execute(['accountNumber' => $accountNumber]);
        
        // Fetch results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
    }
?>
