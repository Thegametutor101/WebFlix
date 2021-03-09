<?php


$connection = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308",
    "root",
    "");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {

    $requete = ("Delete from formnouveaucontenu where idNouveauContenu=:idNouveauContenu");
    $declaration = $connection->prepare($requete);
    $declaration->bindParam(':idNouveauContenu', $_POST["idNouveauContenu"]);
    $declaration->execute();


    echo json_encode(array("item" => "ok"));
} catch
(PDOException $e) {
    echo $e;
}