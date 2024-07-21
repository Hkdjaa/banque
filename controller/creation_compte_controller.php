<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../model/connexion.php';
    include '../model/client.php';
    include '../model/comptebancaire.php';

    class Creation extends CompteBancaire {
        public function __construct($numero_compte, $client_id) {
            $this->setNumeroCompte($numero_compte);
            $this->setClientId($client_id);
        }
    }

    if (isset($_POST['numero_compte']) && isset($_POST['id'])) {
        $numero_compte = $_POST['numero_compte'];
        $client_id = $_POST['id'];

        // Créer un objet CompteBancaire avec le client_id
        $compteBancaire = new Creation($numero_compte, $client_id);

        try {
            $sql = "INSERT INTO comptebancaire (numero_compte, client_id) VALUES (?, ?)";
            $stmt = $connect->prepare($sql);

            if ($stmt->execute([$compteBancaire->getNumeroCompte(), $compteBancaire->getClientId()])) {
                $message = "Compte créé avec succès !";
            } else {
                $message = "Erreur lors de la création du compte : " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    } else {
        $message = "Tous les champs doivent être remplis.";
    }
    header("Location: ../view/creation_compte_view.php?message=" . urlencode($message));
}
?>
