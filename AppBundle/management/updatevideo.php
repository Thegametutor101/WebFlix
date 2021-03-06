<?php
$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!empty($_POST["req"]) && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["genre"]) && !empty($_POST["releasedate"]) && isset($_POST["visible"]) && !empty($_POST["type"]) && !empty($_POST["classificiations"])  && !empty($_POST["id"])) {
    $req = $_POST["req"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $releasedate = $_POST["releasedate"];
    $visible = $_POST["visible"];
    $type = $_POST["type"];
    $id = $_POST["id"];
    $genre = $_POST["genre"];
    $classificiations = $_POST["classificiations"];

    if ($req == "no_file"){

        updateVideo_noFile($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $id, $connexion);
        echo json_encode("OK");

    } elseif ($req == "no_image" && ($_FILES['moviefile']['tmp_name'] != "" || $_FILES['moviefile']['size'] != 0)){

        $dossier2 = '../ressources/assets/videos/';
        $chemin2 = $dossier2 . basename($_FILES['moviefile']['name']);

        if (move_uploaded_file($_FILES['moviefile']['tmp_name'], $chemin2)) {
            updateVideo_noImage($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin2, $id, $connexion);
            echo json_encode("OK");
        } else {
            echo json_encode("Une erreur s'est produite");
        }

    } elseif ($req == "no_video" && ($_FILES['movieimage']['tmp_name'] != "" || $_FILES['movieimage']['size'] != 0)){

        $dossier = '../ressources/assets/images/videoImages/';
        $chemin = $dossier . basename($_FILES['movieimage']['name']);

        if (move_uploaded_file($_FILES['movieimage']['tmp_name'], $chemin)) {
            updateVideo_noVideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $id, $connexion);
            echo json_encode("OK");
        } else {
            echo json_encode("Une erreur s'est produite");
        }

    } elseif (($_FILES['movieimage']['tmp_name'] != "" || $_FILES['movieimage']['size'] != 0) && ($_FILES['moviefile']['tmp_name'] != "" || $_FILES['moviefile']['size'] != 0)){

        $dossier = '../ressources/assets/images/videoImages/';
        $chemin = $dossier . basename($_FILES['movieimage']['name']);

        if (move_uploaded_file($_FILES['movieimage']['tmp_name'], $chemin)) {
            $dossier2 = '../ressources/assets/videos/';
            $chemin2 = $dossier2 . basename($_FILES['moviefile']['name']);
        }
        if (move_uploaded_file($_FILES['moviefile']['tmp_name'], $chemin2)) {
            updatevideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $chemin2, $id, $connexion);
            echo json_encode("OK");
        } else {
            echo json_encode("Une erreur s'est produite");
        }

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

function updateVideo_noImage($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin2, $id, $connexion)
{
    try {
        $requete = "update cards set Title = '$title', Genre = '$genre', Resume = '$description', File = '$chemin2', ReleaseDate = '$releasedate', Available = '$visible', Classification = '$classificiations', Type = '$type' where ID = '$id'";
        $connexion->exec($requete);
    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}

function updateVideo_noVideo($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $chemin, $id, $connexion)
{
    try {
        $requete = "update cards set Title = '$title', Genre = '$genre', Resume = '$description', Image = '$chemin', ReleaseDate = '$releasedate', Available = '$visible', Classification = '$classificiations', Type = '$type' where ID = '$id'";
        $connexion->exec($requete);
    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}

function updateVideo_noFile($title, $genre, $description, $releasedate, $visible, $type, $classificiations, $id, $connexion)
{
    try {
        $requete = "update cards set Title = '$title', Genre = '$genre', Resume = '$description', ReleaseDate = '$releasedate', Available = '$visible', Classification = '$classificiations', Type = '$type' where ID = '$id'";
        $connexion->exec($requete);
    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}