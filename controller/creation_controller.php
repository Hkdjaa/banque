<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../model/connexion.php';
    include '../model/client.php';

    class Creation extends Client {
        function __construct($nom_client, $Prenom_client, $telephone_client) {
            $this->setNom_client($nom_client);
            $this->setPrenom_client($Prenom_client);
            $this->setTelephone_client($telephone_client);
        }
        public function deleteUser($id) {
            return $this->userModel->deleteUser($id);
        }
    }

    if (isset($_POST['Prenom_client']) && isset($_POST['nom_client']) && isset($_POST['phoneNumber'])) {
        $Prenom_client = $_POST['Prenom_client'];
        $nom_client = $_POST['nom_client'];
        $telephone_client = $_POST['phoneNumber'];

        try {
            $sql = "INSERT INTO client (Nom_client, Prenom_client, telephone_client) VALUES (?, ?, ?)";
            $stmt = $connect->prepare($sql);

            if ($stmt->execute([$nom_client, $Prenom_client, $telephone_client])) {
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
    header("Location: ../view/creation_view.php?message=" . urlencode($message));
}
?>
