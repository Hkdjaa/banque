<?php
// Connexion à la base de données
include '../model/connexion.php';
include '../model/operationbancaire.php';

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyage et validation des données
    $idCompte = isset($_POST["id"]) ? trim($_POST["id"]) : '';
    $montant = isset($_POST["montant"]) ? trim($_POST["montant"]) : '';

    $errors = [];

    // Validation des données
    if (empty($idCompte) || empty($montant)) {
        $errors[] = "Tous les champs doivent être remplis.";
    }

    if (!is_numeric($idCompte)) {
        $errors[] = "L'identifiant du compte doit être un nombre.";
    }

    if (!is_numeric($montant) || $montant <= 0) {
        $errors[] = "Le montant doit être un nombre positif.";
    }

    if (empty($errors)) {
        try {
            // Création de l'objet OperationBancaire avec la connexion à la base de données
            $operationBancaire = new OperationBancaire($connect);

            // Appel de la méthode effectuerDepot pour effectuer le dépôt
            $resultat = $operationBancaire->effectuerDepot($idCompte, $montant);

            if ($resultat === "Dépôt effectué avec succès !") {
                // Récupération du nouveau solde
                $stmt = $connect->prepare("SELECT solde FROM comptebancaire WHERE id = ?");
                $stmt->execute([$idCompte]);
                $nouveauSolde = $stmt->fetchColumn();

                echo "Dépôt effectué avec succès. Nouveau solde : " . $nouveauSolde;
            } else {
                echo $resultat;
            }
        } catch (Exception $e) {
            // Gestion des erreurs
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Affichage des erreurs
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
    // Redirection avec le message
    header("Location: ../view/depot_view.php?message=" . urlencode($message));
    exit();
}
?>
