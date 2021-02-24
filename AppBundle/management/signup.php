<?php
require_once(__DIR__ . "/DB/Entity/EntityAccounts.php");
require_once(__DIR__ . "/DB/Model/ModelAccounts.php");
$entityAccount = new EntityAccounts();
$modelAccount = new ModelAccounts();
if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["screenName"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $screenName = $_POST["screenName"];
    if (!$entityAccount->checkAccountEmailUsed($email)) {
        if (!$entityAccount->checkAccountScreenNameUsed($screenName)) {
            $result = $modelAccount->addAccount($email, $password, $phone,$screenName, '', 0);
            if ($result === "ok") {
                echo json_encode(array('item' => 'ok'));
            } else {
                echo json_encode(array('item' => 'error'));
            }
        } else {
            echo json_encode(array('item' => 'screenName'));
        }
    } else {
        echo json_encode(array('item' => 'email'));
    }
} else {
    echo json_encode(array('item' => 'empty'));
}