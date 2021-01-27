<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$objet = new ModelAccounts();
if (isset($_POST["email"]) && isset($_POST["pwd"])) {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    try {
        $account = $objet->updateAccountPassword($email, $pwd);
        echo json_encode($account);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}

