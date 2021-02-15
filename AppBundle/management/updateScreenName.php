<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
require_once(__DIR__ . "/DB/Entity/EntityAccounts.php");
$modelAccounts = new ModelAccounts();
$entityAccount = new EntityAccounts();
if (!empty($_POST["screenName"]) && !empty($_POST["email"])) {
    $screenName = $_POST["screenName"];
    $email = $_POST["email"];
    try {
        if (!$entityAccount->checkAccountScreenNameUsed($screenName)) {
            $result = $modelAccounts->updateAccountScreenName($email, $screenName);
            if ($result == "ok") {
                echo json_encode(array("item" => $result));
            } else {
                echo json_encode(array("item" => "error"));
            }
        } else {
            echo json_encode(array("item" => "used"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("item" => "Échec de connexion à la base de données: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("item" => "empty"));
}