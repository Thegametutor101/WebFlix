<?php
$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["genre"]) && !empty($_POST["releasedate"]) && isset($_POST["visible"]) && !empty($_POST["type"]) && !empty($_POST["classificiations"]) && ($_FILES['movieimage']['tmp_name'] != "" || $_FILES['movieimage']['size'] != 0) && ($_FILES['moviefile']['tmp_name'] != "" || $_FILES['moviefile']['size'] != 0)) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $releasedate = $_POST["releasedate"];
    $visible = $_POST["visible"];
    $type = $_POST["type"];
    $genre = $_POST["genre"];
    $classificiations = $_POST["classificiations"];
    $dossier = __DIR__.'/../ressources/assets/images/videoImages/';
    $chemin = $dossier . basename($_FILES['movieimage']['name']);
    if (move_uploaded_file($_FILES['movieimage']['tmp_name'], $chemin)) {
        $dossier = __DIR__.'/../ressources/assets/videos/';
        $chemin2 = $dossier . basename($_FILES['moviefile']['name']);
    }
    if (move_uploaded_file($_FILES['moviefile']['tmp_name'], $chemin2)) {
        addvideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $chemin2, $connexion);
        echo json_encode("OK");
    } else {
        echo json_encode("Une erreur s'est produite");
    }
}
else
    echo json_encode("FUCK OFF");


function addvideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $chemin2, $connexion)
{
    try {
        $requete = "INSERT INTO cards (Title, Genre, Resume, Image, File, ReleaseDate, Available, Classification, Duration, Type) VALUES ('$title', '$genre', '$description', '$chemin', '$chemin2', '$releasedate', '$visible', '$classificiations', 0, '$type')";
        $connexion->exec($requete);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}