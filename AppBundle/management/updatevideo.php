<?php
$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["genre"]) && !empty($_POST["releasedate"]) && isset($_POST["visible"]) && !empty($_POST["type"]) && !empty($_POST["classificiations"])  && !empty($_POST["id"]) && ($_FILES['movieimage']['tmp_name'] != "" || $_FILES['movieimage']['size'] != 0) && ($_FILES['moviefile']['tmp_name'] != "" || $_FILES['moviefile']['size'] != 0)) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $releasedate = $_POST["releasedate"];
    $visible = $_POST["visible"];
    $type = $_POST["type"];
    $id = $_POST["id"];
    $genre = $_POST["genre"];
    $classificiations = $_POST["classificiations"];
    $dossier = '../ressources/assets/images/videoImages/';
    $chemin = $dossier . basename($_FILES['movieimage']['name']);
    if (move_uploaded_file($_FILES['movieimage']['tmp_name'], $chemin)) {
        $dossier = '../ressources/assets/videos/';
        $chemin2 = $dossier . basename($_FILES['moviefile']['name']);
    }
    if (move_uploaded_file($_FILES['moviefile']['tmp_name'], $chemin2)) {
        updatevideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $chemin2, $id, $connexion);
        echo json_encode("OK");
    } else {
        echo json_encode("Une erreur s'est produite");
    }
}
else
    echo json_encode("FUCK OFF");


function updatevideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $chemin2, $id, $connexion)
{
    try {
        $requete = "update cards set Title = '$title', Genre = '$genre', Resume = '$description', Image = '$chemin', File = '$chemin2', ReleaseDate = '$releasedate', Available = '$visible', Classification = '$classificiations', Type = '$type' where ID = '$id'";
        $connexion->exec($requete);
    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}