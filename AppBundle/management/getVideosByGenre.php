<?php
require_once (__DIR__."/DB/Entity/EntityCards.php");
$objet = new EntityCards();
if (isset($_POST["genre"])) {
    $genre = $_POST["genre"];
    try {
        $card = $objet->getCardByGenre($genre);
        echo json_encode($card);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}
