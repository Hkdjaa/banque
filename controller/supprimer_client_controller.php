<?php
include '../model/connexion.php';

// Vérifier si l'identifiant est passé en paramètre
if (isset($_GET['id'])) {
    // Nettoyer et valider l'identifiant
    $id = trim($_GET['id']);

    // Vérifier que l'identifiant n'est pas vide et est un nombre valide
    if (empty($id) || !is_numeric($id)) {
        echo "Identifiant invalide.";
        exit;
    }

    try {
        // Préparer la requête SQL pour supprimer le client
        $sql = "DELETE FROM client WHERE ID_client = :id";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger vers la vue de liste des clients après suppression
            header("Location: ../view/liste_clients_view.php");
            exit;
        } else {
            echo "Erreur lors de la suppression du client.";
        }
    } catch (PDOException $e) {
        // Gestion des exceptions en cas d'erreur de base de données
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Aucun identifiant spécifié.";
}
?>
