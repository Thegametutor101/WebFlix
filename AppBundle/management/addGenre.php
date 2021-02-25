<?php
require_once ('DB/Model/ModelGenre.php');
$modelGenre = new ModelGenre();
echo json_encode($modelGenre->addGenre($_POST['name']));