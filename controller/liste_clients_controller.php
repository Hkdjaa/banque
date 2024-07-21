<?php
// Inclusion des fichiers nécessaires
include '../model/connexion.php';
include '../model/client.php';

// Récupération des clients filtrés
$clients = Client::getClients($connect, $filters);

// Inclusion de la vue
include '../views/liste_clients_view.php';
// Assurez-vous que la connexion est établie correctement
if (!$connect) {
    die("Erreur de connexion à la base de données.");
}

// Créer une instance de la classe Client avec la connexion à la base de données
$clientManager = new Client($connect);

// Obtenir la liste de tous les clients
try {
    $clients = $clientManager->getAllClients();
} catch (Exception $e) {
    $clients = []; // Assurez-vous que $clients est défini même en cas d'erreur
    $errorMessage = "Erreur lors de la récupération des clients : " . $e->getMessage();
}

// Inclure la vue pour afficher les clients
require_once '../view/liste_clients_view.php';

// Initialisation du tableau des filtres
$filters = [
    'ID_client' => isset($_GET['ID_client']) ? $_GET['ID_client'] : '',
    'nom_client' => isset($_GET['nom_client']) ? $_GET['nom_client'] : '',
    'Prenom_client' => isset($_GET['Prenom_client']) ? $_GET['Prenom_client'] : '',
    'email_client' => isset($_GET['email_client']) ? $_GET['email_client'] : '',
    'telephone_client' => isset($_GET['telephone_client']) ? $_GET['telephone_client'] : '',
    'adresse_client' => isset($_GET['adresse_client']) ? $_GET['adresse_client'] : '',
    'sexe' => isset($_GET['sexe']) ? $_GET['sexe'] : '',
    'statut' => isset($_GET['statut']) ? $_GET['statut'] : ''
];

?>

