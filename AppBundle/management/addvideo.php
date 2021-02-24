<?php
require_once ('DB/Model/ModelCards.php');
$modelCards = new ModelCards();
if (!empty($_POST["title"]) &&
    !empty($_POST["description"]) &&
    !empty($_POST["genre"]) &&
    !empty($_POST["releasedate"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $releasedate = $_POST["releasedate"];
    $visible = $_POST["visible"];
    $type = $_POST["type"];
    $genre = $_POST["genre"];
    $classificiations = $_POST["classificiations"];
    $dossier = __DIR__.'/../ressources/assets/images/videoImages/';
    $chemin = $dossier . basename($_FILES['movieimage']['name']);
    $duration = $_FILES['moviefile']['playtime_string'];
    if (move_uploaded_file($_FILES['movieimage']['tmp_name'], $chemin)) {
        $dossier = __DIR__.'/../ressources/assets/videos/';
        $chemin2 = $dossier . basename($_FILES['moviefile']['name']);
    }
    if (move_uploaded_file($_FILES['moviefile']['tmp_name'], $chemin2)) {
        echo json_encode("OK");
    } else {
        echo json_encode("Une erreur s'est produite");
    }
}
else
    echo json_encode("FUCK OFF");