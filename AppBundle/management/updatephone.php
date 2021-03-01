<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$modelAccounts = new ModelAccounts();
if (!empty($_POST["email"]) && !empty($_POST["phone"])) {
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    try {
        $result = $modelAccounts->updateAccountPhone($email, $phone);
        if ($result == "ok") {
            echo json_encode(array("item" => $result));
        } else {
            echo json_encode(array("item" => "error"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("item" => "Échec de connexion à la base de données: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("item" => "empty"));
}