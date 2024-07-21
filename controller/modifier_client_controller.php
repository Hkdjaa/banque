<?php
include '../model/connexion.php'; // Inclure la connexion à la base de données

// Fonction pour nettoyer les entrées
function nettoyerEntree($data) {
    return htmlspecialchars(trim($data));
}

// Débogage: vérifier la présence de l'ID dans l'URL
if (isset($_GET['id'])) {
    echo "ID reçu : " . htmlspecialchars($_GET['id']) . "<br>"; // Débogage

    // Valider et nettoyer l'identifiant
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($id === false) {
        die("Identifiant invalide.");
    }

    // Préparer et exécuter la requête pour récupérer les informations actuelles du client
    $sql = "SELECT * FROM client WHERE ID_client = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Client non trouvé.");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Nettoyer et valider les données POST
        $nom = nettoyerEntree($_POST['nom']);
        $prenom = nettoyerEntree($_POST['prenom']);
        $telephone = nettoyerEntree($_POST['telephone']);
        $adresse = nettoyerEntree($_POST['adresse']);
        $email = nettoyerEntree($_POST['email']);
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
        $statut = isset($_POST['statut']) ? $_POST['statut'] : '';

        // Validation des données
        if (empty($nom) || empty($prenom) || empty($telephone) || empty($adresse) || empty($email) || empty($sexe) || empty($statut)) {
            $message = "Tous les champs doivent être remplis.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "L'email est invalide.";
        } elseif (!preg_match("/^[a-zA-Z-' ]+$/", $nom)) {
            $message = "Le nom ne peut contenir que des lettres et des espaces.";
        } elseif (!preg_match("/^[a-zA-Z-' ]+$/", $prenom)) {
            $message = "Le prénom ne peut contenir que des lettres et des espaces.";
        } elseif (!in_array($sexe, ['M', 'F'])) {
            $message = "Le sexe doit être 'M' ou 'F'.";
        } elseif (!in_array($statut, ['actif', 'inactif'])) {
            $message = "Le statut doit être 'actif' ou 'inactif'.";
        } else {
            try {
                // Préparer et exécuter la requête pour mettre à jour les informations du client
                $sql = "UPDATE client 
                        SET Nom_client = :nom, Prenom_client = :prenom, telephone_client = :telephone, 
                            adresse_client = :adresse, email_client = :email, sexe = :sexe, statut = :statut 
                        WHERE ID_client = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':telephone', $telephone);
                $stmt->bindParam(':adresse', $adresse);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':sexe', $sexe);
                $stmt->bindParam(':statut', $statut);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    header("Location: ../view/modifier_liste_clients_view.php?message=" . urlencode("Client mis à jour avec succès."));
                    exit;
                } else {
                    $message = "Erreur lors de la mise à jour du client : " . $stmt->errorInfo()[2];
                }
            } catch (PDOException $e) {
                $message = "Erreur : " . $e->getMessage();
            }
        }
    }
} else {
    echo " Informations modifiées !";
    header("Location: ../view/liste_clients_view.php?message=" . urlencode($message));
exit();

}

// Afficher le message d'erreur s'il y en a
if (isset($message)) {
    echo "<p>$message</p>";
}

?>
