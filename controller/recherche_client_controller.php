<?php
require_once '../model/connexion.php';
require_once '../model/client.php';

class ClientController {
    private $clientManager;

    public function __construct($db) {
        $this->clientManager = new Client($db);
    }

    public function searchClients($search) {
        $search = trim($search);
        return $this->clientManager->getMatchingClients($search);
    }

    public function viewTransactions($accountNumber) {
        $accountNumber = trim($accountNumber);
        return $this->clientManager->getAccountTransactions($accountNumber);
    }
}

// Connexion à la base de données
try {
    $db = new PDO('mysql:host=mysql-hadja.alwaysdata.net;dbname=hadja_cb', 'hadja', 'Hadja.2004');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$clientController = new ClientController($db);

$clients = [];
$transactions = [];
$accountNumber = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search_submit']) || isset($_POST['search'])) {
        if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
            $search = $_POST['search'];
            $clients = $clientController->searchClients($search);
            if (!empty($clients)) {
                foreach ($clients as $client) {
                    echo "<div>";
                    echo "<strong>" . htmlspecialchars($client['nom_client']) . ' ' . htmlspecialchars($client['prenom_client']) . "</strong><br>";
                    echo "Téléphone: " . htmlspecialchars($client['telephone_client']) . "<br>";
                    echo "Email: " . htmlspecialchars($client['email_client']) . "<br>";
                    echo "Adresse: " . htmlspecialchars($client['adresse_client']) . "<br>";
                    echo "Sexe: " . htmlspecialchars($client['sexe']) . "<br>";
                    echo "Statut: " . htmlspecialchars($client['statut']) . "<br>";
                    echo "Compte: " . htmlspecialchars($client['numero_compte']) . "<br>";
                    echo "Solde: " . htmlspecialchars($client['solde']) . "<br>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='accountNumber' value='" . htmlspecialchars($client['numero_compte']) . "'>";
                    echo "<button type='submit' name='view_transactions'>Voir Transactions</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun client trouvé pour cette recherche.</p>";
            }
        } else {
            echo "<p>Le champ de recherche ne peut pas être vide.</p>";
        }
    }

    if (isset($_POST['view_transactions'])) {
        if (isset($_POST['accountNumber']) && !empty(trim($_POST['accountNumber']))) {
            $accountNumber = $_POST['accountNumber'];
            $transactions = $clientController->viewTransactions($accountNumber);
            if (!empty($transactions)) {
                echo "<h2>Transactions pour le compte " . htmlspecialchars($accountNumber) . "</h2>";
                echo "<ul>";
                foreach ($transactions as $transaction) {
                    echo "<li>" . htmlspecialchars($transaction['date']) . ' - ' . htmlspecialchars($transaction['montant']) . ' - ' . htmlspecialchars($transaction['type']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Aucune transaction trouvée pour ce compte.</p>";
            }
        } else {
            echo "<p>Le numéro de compte ne peut pas être vide.</p>";
        }
    }
}
?>
