<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$objet = new ModelAccounts();
if (isset($_POST["email"]) && isset($_POST["phone"])) {
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    try {
        $account = $objet->updateAccountPhone($email, $phone);
        echo json_encode($account);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}