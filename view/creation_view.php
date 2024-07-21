<?php include '../public/includes/first.php'; ?>

                    <!-- Banner -->
                    <section id="banner">
                        <div class="content">
                            <header>
                                <h1>Création d'un client</h1>
                            </header>
                            <p>Remplissez ce formulaire pour créer un compte!</p>
                            <br>
                            <br>
                            <div class="posts">
                                <article>
                                    <form action="../controller/creation_controller.php" method="post">
                                        <div class="fields">
                                            <div class="field">
                                                <label for="Prenom_client">Prénom</label>
                                                <input type="text" name="Prenom_client" id="Prenom_client" placeholder="Prénom" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <label for="nom_client">Nom</label>
                                                <input type="text" name="nom_client" id="nom_client" placeholder="Nom" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <label for="phoneNumber">Numéro de téléphone</label>
                                                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Numéro de téléphone" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                                <label for="adresse">Adresse physique</label>
                                                <input type="text" name="adresse" id="adresse" placeholder="Adresse physique" required />
                                            </div>
                                            <br>
                                            <div class="field">
                                              <label for="sexe">Sexe</label>
                                                 <select name="sexe" id="sexe" required>
                                                     <option value="">Sélectionnez un sexe</option>
                                                    <option value="masculin">Masculin</option>
                                                    <option value="féminin">Féminin</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="field">
                                                <label for="statut">Statut</label>
                                                <select name="statut" id="statut" required>
                                                    <option value="">Sélectionnez un statut</option>
                                                    <option value="actif">Actif</option>
                                                    <option value="inactif">Inactif</option>
                                                </select>
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
                            <img src="../public/images/pic06.jpg" alt="" />
                        </span>
                    </section>
                </div>
            </div>

            <!-- Sidebar -->
            <?php include '../public/includes/sidebar.php'; ?>

        </div>

        <!-- Scripts -->
        <?php include '../public/includes/scripts-communs.php'; ?>