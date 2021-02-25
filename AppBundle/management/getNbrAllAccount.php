<?php
require_once (__DIR__."/DB/Entity/EntityAccounts.php");
$entityAccounts = new EntityAccounts(); 
{
    try 
    {
        $account = $entityAccounts->getNbrAccount();
        echo json_encode(array($account));
    } catch (PDOException $e) 
    {
        echo json_encode(array("item" => "Échec de connexion à la base de données: " . $e->getMessage()));
    }
}