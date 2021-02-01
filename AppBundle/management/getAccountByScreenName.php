<?php
require_once (__DIR__."/DB/Entity/EntityAccounts.php");
$entityAccounts = new EntityAccounts();
if (!empty($_POST["screenName"])) {
    $screenName = $_POST["screenName"];
    try {
        $account = $entityAccounts->getAccountByScreenName($screenName);
        echo json_encode(array("item" => $account));
    } catch (PDOException $e) {
        echo json_encode(array("item" => "Échec de connexion à la base de données: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("item" => "error"));
}