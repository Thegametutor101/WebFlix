<?php
require_once (__DIR__."/DB/Entity/EntityFavorites.php");
$objet = new EntityFavorites();
    try {
        $card = $objet->getFavoritesMovieTitleAndCtr();
        echo json_encode($card);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }