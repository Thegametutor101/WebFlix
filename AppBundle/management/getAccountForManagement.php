<?php

require_once (__DIR__."/DB/Entity/EntityAccounts.php");
$entityAccounts = new EntityAccounts();

echo json_encode(array("item" => $entityAccounts->getAccounts()));


