<?php include '../public/includes/first.php'; ?>

            <!-- Banner -->
            <section id="banner">
                <div class="content">
                    <header>
                        <h1>Récuperer le montant d'un virement bancaire</h1>
                    </header>
                    <p>Remplissez ce formulaire pour annuler une transaction</p>
                </div>
                <span class="image object">
                    <img src="../public/images/pic05.jpg" alt="" />
                </span>
            </section>
            
            <section>
                <div class="posts">
                <article>
                    <h2>Recherche de client</h2>
                    <label for="client">Saisissez l'identifiant du client :</label>
                    <input type="text" id="client" placeholder="Rechercher un client">

                    <select id="listeClients">
                        <!-- Les options seront ajoutées dynamiquement -->
                    </select>

                    <div id="informationsClient">
                        <!-- Les informations du compte bancaire seront affichées ici -->
                    </div>

                    <!-- Tableau des relevés -->
                    <div id="transactionsClient">
                        <!-- Les récentes transactions du client seront affichées ici -->
                    </div>
                </article>
                </div>
            </section>
        </div>
    </div>

    <!-- Sidebar -->
    <?php include '../public/includes/sidebar.php'; ?>
</div>

<!-- Scripts -->
<?php include '../public/includes/scripts-communs.php'; ?>

<!-- Script pour la page d'annulation de transaction -->
<script src="../public/assets/js/annuler_transaction.js"></script>
