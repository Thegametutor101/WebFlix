<?php
require_once ('DB/Model/ModelCards.php');
$modelCards = new ModelCards();
if (!empty($_POST["title"]) &&
    !empty($_POST["description"]) &&
    !empty($_POST["genre"]) &&
    !empty($_POST["releasedate"])) {
    $date = date_timestamp_get(new DateTime());
    $title = $_POST["title"];
    $description = $_POST["description"];
    $releasedate = $_POST["releasedate"];
    $visible = $_POST["visible"];
//    $type = $_POST["type"];
    $genre = $_POST["genre"];
    $classificiations = $_POST["classificiations"];
    $dossier = '../ressources/assets/images/videoImages/';
    $chemin = $dossier . $date . basename($_FILES['movieimage']['name']);
    // $duration = $_FILES['moviefile'];
    // $duration = $_FILES['moviefile']['playtime_string'];
    if (move_uploaded_file($_FILES['movieimage']['tmp_name'], $chemin)) {
        $dossier = '../ressources/assets/videos/';
        $chemin2 = $dossier . $date . basename($_FILES['moviefile']['name']);
    }
    if (move_uploaded_file($_FILES['moviefile']['tmp_name'], $chemin2)) {
        $modelCards->addCard($title,
            $genre,
            $description,
            $chemin,
            $chemin2,
            $releasedate,
            $visible,
            $classificiations,
            0);
        echo json_encode("OK");
    } else {
        echo json_encode("Une erreur s'est produite");
    }
} else {
    echo json_encode("error adding video to system");
}