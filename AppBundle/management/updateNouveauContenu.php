<?php

$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308",
    "root",
    "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $requete = ("update formnouveaucontenu set Status='Approuve' where idNouveauContenu = :idNouveauContenu;");
    $declaration = $connexion->prepare($requete);
    $declaration->bindParam(':idNouveauContenu', $_POST["idNouveauContenu"]);
    $declaration->execute();
    echo json_encode(array("item" => "ok"));
} catch
(PDOException $e) {

}