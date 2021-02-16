<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$modelAccounts = new ModelAccounts();

echo json_encode($modelAccounts->removeAccountByEmail($_POST['id']));