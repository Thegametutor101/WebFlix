<?php
require_once(__DIR__ . "/DB/Entity/EntityAccounts.php");
$objet = new EntityAccounts();
if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $emailaccount = $_POST["email"];
    $passwordaccount = $_POST["password"];
    try {
        if ($objet->checkAccountEmailUsed($emailaccount)) {
            $account = $objet->getAccountByEmail($emailaccount);
            if ($passwordaccount == $account["Password"]) {
                    echo json_encode($account);
            }
            else
                echo json_encode(false);

            } else
            echo json_encode(false);

    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}
else
    echo json_encode(false);