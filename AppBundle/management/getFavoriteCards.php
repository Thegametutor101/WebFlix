<?php
require_once (__DIR__."/DB/Entity/EntityCards.php");
$objet = new EntityCards();
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    try {
        $card = $objet->getCardMyFavorites($email);
        echo json_encode($card);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}
