<?php include '../public/includes/first.php'; ?>

                    <!-- Banner -->
                    <section id="banner">
                        <div class="content">
                            <header>
                                <h1>Création de compte</h1>
                            </header>
                            <p>Remplissez ce formulaire pour créer un compte!</p>
                            <br>
                            <div class="posts">
                                <article>
                                    <form action="../controller/creation_compte_controller.php" method="post">
                                        <div class="fields">
                                            <div class="field">
                                                <label for="numero_compte">Numéro de compte</label>
                                                <input type="text" name="numero_compte" id="numero_compte" placeholder="Numéro de compte" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <label for="id">Identifiant du client</label>
                                                <input type="text" name="id" id="id" placeholder="Identifiant du client" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <input type="submit" value="Créer le compte" class="button primary" />
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
                            <img src="../public/images/pic07.jpg" alt="" />
                        </span>
                    </section>
                </div>
            </div>

            <!-- Sidebar -->
    <?php include '../public/includes/sidebar.php'; ?>

        </div>

        <!-- Scripts -->
        <?php include '../public/includes/scripts-communs.php'; ?>