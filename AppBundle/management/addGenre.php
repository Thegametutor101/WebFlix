<?php
require_once ('DB/Model/ModelGenre.php');
require_once ('DB/Entity/EntityGenre.php');
$modelGenre = new ModelGenre();
$entityGenre = new EntityGenre();
if (!$entityGenre->checkGenreUsed($_POST['name'])) {
    echo json_encode($modelGenre->addGenre($_POST['name']));
} else {
    echo json_encode(false);
}
