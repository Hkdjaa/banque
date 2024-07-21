<?php
require_once('../model/connexion.php');
require_once('../model/RetraitBancaire.php');

// Vérifier si la requête est une soumission POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyer et valider les données d'entrée
    $numero_compte = isset($_POST['numero_compte']) ? trim($_POST['numero_compte']) : '';
    $montant = isset($_POST['montant']) ? trim($_POST['montant']) : '';

    // Tableau pour stocker les messages d'erreur
    $errors = [];

    // Validation des données
    if (empty($numero_compte)) {
        $errors[] = "Le champ 'numero_compte' est obligatoire.";
    }

    if (empty($montant)) {
        $errors[] = "Le champ 'montant' est obligatoire.";
    }

    if (!is_numeric($numero_compte)) {
        $errors[] = "Le numéro de compte doit être un nombre valide.";
    }

    if (!is_numeric($montant) || $montant <= 0) {
        $errors[] = "Le montant doit être un nombre positif.";
    }

    // Affichage des erreurs si des validations échouent
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }

    try {
        // Créer une instance de RetraitBancaire avec les données de connexion
        $retrait = new RetraitBancaire($connect, $numero_compte, $montant);

        // Effectuer le retrait
        $resultat = $retrait->effectuerRetrait();

        // Afficher le message en fonction du résultat du retrait
        echo $resultat;
    } catch (Exception $e) {
        // Gestion des exceptions en cas d'erreurs lors de la connexion ou de l'exécution
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode de requête invalide.";
}

    // Redirection avec le message
    header("Location: ../view/retrait_view.php?message=" . urlencode($message));
    exit();
?>
