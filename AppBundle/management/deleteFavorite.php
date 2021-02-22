<?php
require_once (__DIR__."/DB/Model/ModelFavorites.php");
$modelFavorites = new ModelFavorites();
echo json_encode($modelFavorites->deleteFavorite($_POST['email'], $_POST['idCard']));