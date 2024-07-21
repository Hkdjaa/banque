<?php
    $dbhost = 'mysql-hadja.alwaysdata.net';
    $dbname = 'hadja_cb';
    $dbuser = 'hadja';
    $dbpswd = 'Hadja.2004';

try {
    $connect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpswd, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Définit le mode d'erreur sur EXCEPTION
    ));
} catch (PDOException $e) {
    die("Une erreur est survenue lors de la connexion à la Base de données : " . $e->getMessage());
}
?>
