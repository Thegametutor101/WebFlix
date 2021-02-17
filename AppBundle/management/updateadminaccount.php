<?php
require_once (__DIR__."/DB/Model/ModelAccounts.php");
$modelAccounts = new ModelAccounts();
$val = $_POST['val'];
if ($val == "true")
    $val = 1;
else
    $val = 0;
echo json_encode($modelAccounts->updateAccountAdmin($_POST['id'], $val));