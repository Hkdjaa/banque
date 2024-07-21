<?php
require_once '../model/connexion.php';
require_once '../model/transaction.php';

// Connexion à la base de données
try {
    $connect = new PDO('mysql:host=mysql-hadja.alwaysdata.net;dbname=hadja_cb', 'hadja', 'Hadja.2004');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if (isset($_GET['clientId']) && !empty(trim($_GET['clientId']))) {
    $clientId = $_GET['clientId'];
    $transactionManager = new Transaction($connect);
    $transactions = $transactionManager->getTransactionsByClientId($clientId);

    echo json_encode($transactions);
} else {
    echo json_encode(['error' => 'Client ID is required']);
}
?>
