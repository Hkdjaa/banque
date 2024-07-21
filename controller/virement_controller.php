<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../model/connexion.php';
    include '../model/operationbancaire.php';

    // Nettoyage et validation des données
    $id1 = isset($_POST["id1"]) ? trim($_POST["id1"]) : '';
    $id2 = isset($_POST["id2"]) ? trim($_POST["id2"]) : '';
    $montant = isset($_POST["montant"]) ? trim($_POST["montant"]) : '';

    // Validation des données
    if (empty($id1) || empty($id2)) {
        $message = "Les identifiants des comptes ne peuvent pas être vides.";
    } elseif (!is_numeric($id1) || !is_numeric($id2)) {
        $message = "Les identifiants des comptes doivent être des nombres valides.";
    } elseif (empty($montant) || !filter_var($montant, FILTER_VALIDATE_FLOAT) || $montant <= 0) {
        $message = "Le montant doit être un nombre positif.";
    } else {
        $id1 = intval($id1);
        $id2 = intval($id2);
        $montant = floatval($montant);

        // Création de l'objet OperationBancaire avec la connexion à la base de données
        $operationBancaire = new OperationBancaire($connect);

        // Appel de la méthode effectuerVirement pour effectuer le virement
        try {
            $resultat = $operationBancaire->effectuerVirement($id1, $id2, $montant);

            if ($resultat === "Virement effectué avec succès !") {
                $message = "La transaction a été effectuée avec succès.";

                // Récupération des nouveaux soldes
                $stmt = $connect->prepare("SELECT solde FROM comptebancaire WHERE id = ?");
                $stmt->execute([$id1]);
                $soldeEnvoyeur = $stmt->fetchColumn();

                $stmt->execute([$id2]);
                $soldeDestinataire = $stmt->fetchColumn();

                $message .= " Solde du compte source: " . $soldeEnvoyeur . ". Solde du compte destinataire: " . $soldeDestinataire . ".";
            } else {
                $message = $resultat;
            }
        } catch (Exception $e) {
            // Gestion des erreurs d'exécution
            $message = "Erreur : " . $e->getMessage();
        }
    }

    // Redirection avec le message
    header("Location: ../view/virement_view.php?message=" . urlencode($message));
    exit();
}
?>
