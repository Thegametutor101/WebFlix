<?php
require_once (__DIR__."/DB/Entity/EntityCards.php");
$objet = new EntityCards();
    try {
        $card = $objet->getCardMovieVisible();
        echo json_encode($card);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
