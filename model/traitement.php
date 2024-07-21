<?php
if (isset($_POST['client'])) {
    $identifiant = $_POST['client'];
    echo "Informations du compte bancaire du client " . $identifiant . ": ...";
}
