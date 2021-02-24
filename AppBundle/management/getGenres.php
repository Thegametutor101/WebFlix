<?php
require_once (__DIR__."/DB/Entity/EntityCards.php");
$objet = new EntityCards();

        echo json_encode($objet->getGenreCards());
