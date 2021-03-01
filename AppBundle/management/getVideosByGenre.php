<?php
require_once (__DIR__."/DB/Entity/EntityCards.php");
$objet = new EntityCards();
if (isset($_POST["genre"]) && isset($_POST["email"])) {
    $genre = $_POST["genre"];
    $email = $_POST["email"];
    try {
        $card = $objet->getCardByGenre($genre, $email);
        echo json_encode($card);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}
