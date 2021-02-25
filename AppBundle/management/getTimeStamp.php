<?php
require_once (__DIR__."/DB/Entity/EntityTimeSaving.php");
$entityTimeStamp = new EntityTimeSaving();
if (!empty($_POST["cardID"]) && !empty($_POST["email"])) {
    $cardID = $_POST["cardID"];
    $email = $_POST["email"];
    try {
        if($entityTimeStamp->TimeSavingAlreadyExist($cardID, $email) > 0) {
            $time = $entityTimeStamp->getSpecificTimeSaving($cardID, $email);
            echo json_encode($time);
        }
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}