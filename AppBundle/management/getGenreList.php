<?php
require_once ('DB/Entity/EntityGenre.php');
$entityGenre = new EntityGenre();
echo json_encode($entityGenre->getGenre());