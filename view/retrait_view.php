<?php include '../public/includes/first.php'; ?>

                    <section id="banner">
                        <div class="content">
                            <header>
                                <h1>Retrait bancaire</h1>
                            </header>
                            <p>Remplissez ce formulaire pour faire un retrait d'argent sur un compte client</p>
                            <br>
                            <div class="posts">
                                <article>
                                    <form action="../controller/retrait_controller.php" method="post">
                                        <div class="fields">
                                            <div class="field">
                                                <label for="id">Numéro du compte</label>
                                                <input type="text" name="numero_compte" placeholder="Numéro de compte">
                                            </div>
                                            <div class="field">
                                                <label for="somme">Montant</label>
                                                <input type="number" name="montant" id="montant" placeholder="Montant" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <input type="submit" value="Faire le retrait" class="button primary" />
                                            </div>
                                        </div>
                                    </form>
                                </article>
                            </div>
                        </div>
                        <span class="image object">
                            <img src="../public/images/pic03.jpg" alt="" />
                        </span>
                    </section>
                </div>
            </div>
    <!-- Sidebar -->
    <?php include '../public/includes/sidebar.php'; ?>

</div>

    <!-- Scripts -->
    <?php include '../public/includes/scripts-communs.php'; ?>
