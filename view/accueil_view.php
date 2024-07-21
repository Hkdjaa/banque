<?php include '../public/includes/first.php'; ?>

                             <!-- Banner -->
                             <section id="banner">
                                    <div class="content">
                                        <header>
                                            <h1>Accueil </h1>
                                            <p>Système de gestion de comptes bancaires</p>
                                        </header>
                                        <p>Donnez vie aux demandes de vos clients en un simple clic</p>
                                        <ul class="actions">
                                            <li><a href="creation_view.php" class="button big">Créer un nouveau compte client</a></li>
                                        </ul>
                                    </div>
                                    <span class="image object">
                                        <img src="../public/images/pic10.jpg" alt="" />
                                    </span>
                                </section>

            <!-- Section Gestion client -->
            <section>
                <header class="major">
                    <h2>Gestion client</h2>
                </header>
                <div class="posts">
                    <article>
                        <a href="creation_view.php" class="image"><img src="../public/images/pic06.jpg" alt="" /></a>
                        <h3>Création d'un compte</h3>
                        <p>Ici, permettez à un client d'ouvrir un compte en banque, chez nous, de quel type qu'il soit</p>
                        <ul class="actions">
                            <li><a href="creation_view.php" class="button">Création</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="releve_view.php" class="image"><img src="../public/images/pic07.jpg" alt="" /></a>
                        <h3>Relevé du compte client </h3>
                        <p>Consultez le relevé de compte d'un de vos clients, en lui permettant aussi d'y jeter un oeil</p>
                        <ul class="actions">
                            <li><a href="releve_view.php" class="button">Relevé</a></li>
                        </ul>
                    </article>
                </div>
            </section>

            <!-- Section Gestion de compte -->
            <section>
                <header class="major">
                    <h2>Gestion de compte</h2>
                </header>
                <div class="posts">
                    <article>
                        <a href="depot_view.php" class="image"><img src="../public/images/pic02.jpg" alt="" /></a>
                        <h3>Faire un dépot</h3>
                        <p>Permettez à un client d'ajouter ou de mettre une somme dans son compte en banque</p>
                        <ul class="actions">
                            <li><a href="depot_view.php" class="button">Dépot</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="retrait_view.php" class="image"><img src="../public/images/pic03.jpg" alt="" /></a>
                        <h3>Faire un retrait</h3>
                        <p>Permettez à un client de récupérer en liquide de l'argent contenu dans son compte en banque</p>
                        <ul class="actions">
                            <li><a href="retrait_view.php" class="button">Retrait</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="virement_view.php" class="image"><img src="../public/images/pic04.jpg" alt="" /></a>
                        <h3>Faire un virement</h3>
                        <p>Permettez à un client de faire une transaction à partir de son compte ou dans son compte en banque</p>
                        <ul class="actions">
                            <li><a href="virement_view.php" class="button">Virement</a></li>
                        </ul>
                    </article>
                    <article>
                        <a href="annuler_transaction_view.php" class="image"><img src="../public/images/pic05.jpg" alt="" /></a>
                        <h3>Annuler une transaction</h3>
                        <p>Permettez à un client d'annuler une transaction déjà enregistrée, à partir de son compte en banque</p>
                        <ul class="actions">
                            <li><a href="annuler_transaction_view.php" class="button">Transactions</a></li>
                        </ul>
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