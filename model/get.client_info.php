<?php
require_once 'connexion.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si l'identifiant du client est passé en paramètre
if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    // Requête SQL pour récupérer les informations du client
    $sql = "SELECT * FROM Client WHERE ID_client = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':id', $clientId);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le client existe
    if ($client) {
        // Générer le contenu HTML avec les informations du client
        $html = "<p>ID: {$client['ID_client']}</p>";
        $html .= "<p>Nom: {$client['Nom_client']}</p>";
        $html .= "<p>Prénom: {$client['Prenom_client']}</p>";
        // Ajoutez d'autres informations du client au besoin...

        // Envoyer le contenu HTML en réponse
        echo $html;
    } else {
        echo "Client non trouvé.";
    }
} else {
    echo "Identifiant du client non spécifié.";
}
?>
