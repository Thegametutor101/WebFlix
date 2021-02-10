<?php
require_once (__DIR__."/DB/Model/ModelCards.php");
$objet = new ModelCards();

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    try {
        $cards = $objet->deletecard($id);
        echo json_encode("Delete : OK");
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}
else
    echo json_encode("erreur");