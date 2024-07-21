<?php
require_once 'connexion.php';

class Client {
    protected $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    /**
     * Recherche des clients dans la table comptebancaire
     * 
     * @param string $search Mot-clé pour la recherche
     * @return array Tableau associatif des résultats de la recherche
     */
    public function getMatchingClients($search) {
        $search = trim($search); // Nettoyer les entrées
        
        // Préparer la requête SQL pour la recherche des clients
        $sql = "SELECT * FROM comptebancaire WHERE nom_client LIKE :search OR numero_compte LIKE :search";
        $stmt = $this->connect->prepare($sql);
        
        // Exécuter la requête avec le paramètre de recherche
        $stmt->execute(['search' => "%$search%"]);
        
        // Retourner les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtient les transactions pour un numéro de compte spécifique
     * 
     * @param string $accountNumber Numéro de compte bancaire
     * @return array Tableau associatif des transactions
     */
    public function getAccountTransactions($accountNumber) {
        $accountNumber = trim($accountNumber); // Nettoyer les entrées
        
        // Préparer la requête SQL pour obtenir les transactions
        $sql = "SELECT * FROM transactions WHERE numero_compte = :accountNumber";
        $stmt = $this->connect->prepare($sql);
        
        // Exécuter la requête avec le numéro de compte
        $stmt->execute(['accountNumber' => $accountNumber]);
        
        // Retourner les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
