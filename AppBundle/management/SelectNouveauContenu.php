<?php
require_once ("DB/Entity/EntityNewContent.php");
$objet = new EntityNewContent();

echo json_encode($objet->getNewContent());
