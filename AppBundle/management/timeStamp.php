<?php
$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




if (!empty($_POST["cardID"]) && !empty($_POST["email"]) && !empty($_POST["timeStamp"])) {
    $cardID = $_POST["cardID"];
    $email = $_POST["email"];
    $timeStamp = $_POST["timeStamp"];
}
else
    echo json_encode("erreur");


function addTimeStamp($cardID, $email, $timeStamp, $connexion)
{
    try {
        $requete = "INSERT INTO timesaving (CardID, Email, TimeStamp) VALUES ('$cardID', '$email', '$timeStamp')";
        $connexion->exec($requete);
    } catch (PDOException $e) {
        echo "Échec de connexion à la base de données: " . $e->getMessage();
    }
}