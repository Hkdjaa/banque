<?php include '../public/includes/first.php'; ?>

                    <!-- Banner -->
                    <section id="banner">
                        <div class="content">
                            <header>
                                <h1>Dépot bancaire</h1>
                            </header>
                            <p>Remplissez ce formulaire pour faire un dépôt d'argent sur un compte client</p>
                            <div class="posts">
                                <article>
                                    <form action="../controller/depot_controller.php" method="post">
                                        <div class="fields">
                                            <div class="field">
                                                <label for="id">Identifiant</label>
                                                <input type="text" name="id" id="id" placeholder="Numéro bancaire" required />
                                            </div>
                                            <div class="field">
                                                <label for="montant">Montant</label>
                                                <input type="number" name="montant" id="montant" placeholder="Montant" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <input type="submit" value="Faire le dépot" class="button primary" />
                                            </div>
                                            <br>
                                            <?php
                                            if (isset($_GET['message'])) {
                                                echo "<p>{$_GET['message']}</p>";
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </article>
                            </div>
                        </div>
                        <span class="image object">
                            <img src="../public/images/pic02.jpg" alt="" />
                        </span>
                    </section>
                </div>
            </div>

            <!-- Sidebar -->
            <?php include '../public/includes/sidebar.php'; ?>

        </div>

        <!-- Scripts -->
        <?php include '../public/includes/scripts-communs.php'; ?>