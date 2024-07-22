<?php include '../public/includes/first.php'; ?>

                    <!-- Banner -->
                    <section id="banner">
                        <div class="content">
                            <header>
                                <h1>Faire un virement</h1>
                            </header>
                            <p>Ici vous pouvez envoyer de l'argent d'un compte à un autre</p>
                            <br>
                            <div class="posts">
                                <article>
                                    <form action="../controller/virement_controller.php" method="post">
                                        <div class="fields">
                                            <div class="field">
                                                <label for="id1">Numéro compte du client</label>
                                                <input type="text" name="id1" id="id1" placeholder="Numéro bancaire" required />
                                            </div>
                                            <div class="field">
                                                <label for="id2">Numéro compte du destinataire</label>
                                                <input type="text" name="id2" id="id2" placeholder="Numéro bancaire" required />
                                            </div>
                                            <div class="field">
                                                <label for="montant">Montant</label>
                                                <input type="number" name="montant" id="montant" placeholder="Montant" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <input type="submit" value="Faire le virement" class="button primary" />
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
                            <img src="../public/images/pic04.jpg" alt="" />
                        </span>
                    </section>
                </div>
            </div>

    <!-- Sidebar -->
    <?php include '../public/includes/sidebar.php'; ?>

</div>

    <!-- Scripts -->
    <?php include '../public/includes/scripts-communs.php'; ?>
