<?php
require_once '../model/connexion.php';
require_once '../model/transaction.php';

// Connexion à la base de données 
$db = new PDO('mysql:host=mysql-hadja.alwaysdata.net;dbname=hadja_cb', 'hadja', 'Hadja.2004');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$clientId = $_GET['clientId'];
$transactionManager = new Transaction($db);
$transactions = $transactionManager->getTransactionsByClientId($clientId);

echo json_encode($transactions);
?>
