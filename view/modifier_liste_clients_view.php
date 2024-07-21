<?php include '../public/includes/first.php'; ?>
<?php include '../controller/modifier_client_controller.php'; ?>

<section>
    <header class="main">
        <h1>Modifier client</h1>
    </header>
    <form method="POST" action="">
        <div>
            <label for="id">ID du Client</label>
            <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($client['ID_client']); ?>" readonly>
        </div>
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($client['Nom_client']); ?>" required>
        </div>
        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($client['Prenom_client']); ?>" required>
        </div>
        <div>
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="<?php echo htmlspecialchars($client['telephone_client']); ?>" required>
        </div>
        <div>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="<?php echo htmlspecialchars($client['adresse_client']); ?>" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($client['email_client']); ?>" required>
        </div>
        <div>
            <label for="sexe">Sexe</label>
            <select name="sexe" id="sexe" required>
                <option value="M" <?php echo ($client['sexe'] == 'M') ? 'selected' : ''; ?>>Masculin</option>
                <option value="F" <?php echo ($client['sexe'] == 'F') ? 'selected' : ''; ?>>Féminin</option>
            </select>
        </div>
        <div>
            <label for="statut">Statut</label>
            <select name="statut" id="statut" required>
                <option value="actif" <?php echo ($client['statut'] == 'actif') ? 'selected' : ''; ?>>Actif</option>
                <option value="inactif" <?php echo ($client['statut'] == 'inactif') ? 'selected' : ''; ?>>Inactif</option>
            </select>
        </div>
        <br>
        <div>
            <button type="submit">Modifier</button>
        </div>
    </form>
</section>

<!-- Scripts -->
<?php include '../public/includes/scripts-communs.php'; ?>
