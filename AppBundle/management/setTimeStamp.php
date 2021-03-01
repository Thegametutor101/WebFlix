<?php
require_once (__DIR__."/DB/Model/ModelTimeSaving.php");
require_once (__DIR__."/DB/Entity/EntityTimeSaving.php");
$modelTimeStamp = new ModelTimeSaving();
$entityTimeStamp = new EntityTimeSaving();

if (!empty($_POST["cardID"]) && !empty($_POST["email"]) && !empty($_POST["time"])) {
    $cardID = $_POST["cardID"];
    $email = $_POST["email"];
    $time = $_POST["time"];

    try {
        
        if($entityTimeStamp->TimeSavingAlreadyExist($cardID, $email) > 0) {
            echo json_encode($modelTimeStamp->updateTimeSaving($cardID, $email, $time));

        } else {
            echo json_encode($modelTimeStamp->addTimeSaving($cardID, $email, $time));
        }


    } catch (PDOException $e) {
        echo json_encode(array('item' => "Échec de connexion à la base de données: " . $e->getMessage()));
    }

}else {
    echo json_encode(array('item' => 'empty'));
}
