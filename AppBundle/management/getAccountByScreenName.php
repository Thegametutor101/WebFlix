<?php
require_once (__DIR__."/DB/Entity/EntityAccounts.php");
$objet = new EntityAccounts();
if (isset($_POST["screenname"])) {
    $screenname = $_POST["screenname"];
    try {
        $account = $objet->getAccountByScreenName($screenname);
        echo json_encode($account);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}
