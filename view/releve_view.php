<!-- Inclure le header -->
<?php include '../public/includes/first.php'; ?>

<!-- Banner -->
<section id="banner">
    <div class="content">
        <header>
            <h1>Relevé de compte</h1>
        </header>
        <p>Ici vous pouvez consulter le relevé d'un compte</p>
        <p>Entrez l'identifiant ou le numéro de compte du client afin d'apercevoir son porte-feuille</p>
        <br>
        <div class="search-account">
            <h2>Rechercher un Compte Bancaire</h2>
            <form id="search-form">
                <label for="search">Renseigner le numéro de compte ou le nom</label>
                <input type="text" id="search" name="search" required>
                <br>
                <button type="submit" id="search_submit">Rechercher</button>
            </form>
            <div id="loading" style="display: none;">Chargement...</div>
            <div id="results"></div> <!-- Conteneur pour les résultats -->
        </div>
    </div>
    <span class="image object">
        <img src="../public/images/pic07.jpg" alt="" />
    </span>
</section>

<!-- Sidebar -->
<?php include '../public/includes/sidebar.php'; ?>

<!-- Scripts -->
<?php include '../public/includes/scripts-communs.php'; ?>

<!-- Incluez jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-form').on('submit', function(event) {
            event.preventDefault(); // Empêche le rechargement de la page
            $('#loading').show(); // Affiche le message de chargement
            
            $.ajax({
                url: '../controller/recherche_client_controller.php',
                type: 'POST',
                data: $(this).serialize(), // Envoie les données du formulaire
                success: function(response) {
                    $('#loading').hide(); // Cache le message de chargement
                    $('#results').html(response); // Affiche les résultats dans le conteneur
                },
                error: function() {
                    $('#loading').hide();
                    $('#results').html('<p>Une erreur est survenue. Veuillez réessayer.</p>');
                }
            });
        });
    });
</script>
