<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$objet = new ModelAccounts();
if (isset($_POST["screenname"]) && isset($_POST["email"])) {
    $screenname = $_POST["screenname"];
    $emailaccount = $_POST["email"];
    try {
        $account = $objet->updateAccountScreenName($emailaccount, $screenname);
        echo json_encode($account);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}