<?php include '../public/includes/first.php'; ?>

<!-- Bannière -->
<section id="banner">
    <div class="content">
        <header>
            <h1>Liste des clients</h1>
        </header>
        <p>Ici vous pouvez voir tous les clients enregistrés</p>
        <br>
        <span class="image object">
            <img src="../public/images/pic08.jpg" alt="" />
        </span>

        <!-- Formulaire de filtrage -->
        <form method="GET" action="">
            <!-- Your filtering form fields -->
            <!-- Same as before -->
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        <!-- Boutons pour imprimer et exporter -->
        <div>
            <button onclick="printClients()">Imprimer</button>
            <button onclick="exportToPDF()">Exporter en PDF</button>
            <button onclick="exportToCSV()">Exporter en CSV</button>
        </div>

        <div class="posts">
            <article id="clients-list">
            <?php
            // Inclusion du fichier de connexion à la base de données
            include '../model/connexion.php';
            include '../model/client.php';

            // Préparation de la requête SQL avec des filtres
            $sql = "SELECT ID_client, nom_client, Prenom_client, email_client, telephone_client, adresse_client, sexe, statut FROM client WHERE 1=1";

            // Ajout des filtres
            // Same as before

            // Préparation de la requête
            $stmt = $connect->prepare($sql);

            // Liaison des paramètres
            // Same as before

            // Exécution de la requête
            $stmt->execute();

            // Vérification s'il y a des clients
            if ($stmt->rowCount() > 0) {
                echo "<h2>Clients enregistrés :</h2>";
                echo "<ul>";
                // Parcourir les résultats et afficher chaque client
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>";
                    echo "<a href='detailclient.php?id=" . htmlspecialchars($row['ID_client']) . "'>ID : " . htmlspecialchars($row['ID_client']) . "<br> Nom : " . htmlspecialchars($row['nom_client']) . "<br> Prénom : " . htmlspecialchars($row['Prenom_client']) . "<br> Email : " . htmlspecialchars($row['email_client']) . "<br> Téléphone : " . htmlspecialchars($row['telephone_client']) . "<br> Adresse : " . htmlspecialchars($row['adresse_client']) . "<br> Sexe : " . htmlspecialchars($row['sexe']) . "<br> Statut : " . htmlspecialchars($row['statut']) . "</a>";
                    echo "<br>";
                    // Ajouter les liens Modifier et Supprimer
                    echo "<span class='no-print'>";
                    echo "<a href='../view/modifier_liste_clients_view.php?id=" . htmlspecialchars($row['ID_client']) . "' class='btn-modifier'>Modifier</a> | ";
                    echo "<a href='../controller/supprimer_client_controller.php?id=" . htmlspecialchars($row['ID_client']) . "' class='btn-supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\");'>Supprimer</a>";
                    echo "</span>";

                }
                echo "</ul>";

            } else {
                echo "Aucun client enregistré trouvé.";
            }
            ?>
            </article>
        </div>
    </div>
</section>

</div>
    </div>

    <!-- Sidebar -->
    <?php include '../public/includes/sidebar.php'; ?>

</div>

<!-- Scripts -->
<?php include '../public/includes/scripts-communs.php'; ?>

<?php include '../public/includes/fonctions.php'; ?>