<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$objet = new ModelAccounts();
if (isset($_POST["oldemail"]) && isset($_POST["email"])) {
    $oldemail = $_POST["oldemail"];
    $email = $_POST["email"];
    try {
        $account = $objet->updateAccountEmail($email, $oldemail);
        echo json_encode($account);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}
