<?php
require_once(__DIR__ . "/DB/Entity/EntityAccounts.php");
$entityAccount = new EntityAccounts();
if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    try {
        if ($entityAccount->checkAccountEmailUsed($email)) {
            $account = $entityAccount->getAccountByEmail($email);
            if ($password == $account["Password"]) {
                    echo json_encode(array('item' => $account));
            } else {
                echo json_encode(array('item' => 'password'));
            }
        } else {
            echo json_encode(array('item' => 'email'));
        }
    } catch (PDOException $e) {
        echo json_encode(array('item' => "Échec de connexion à la base de données: " . $e->getMessage()));
    }
} else {
    echo json_encode(array('item' => 'empty'));
}