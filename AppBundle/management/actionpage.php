<?php

$username = $_POST["username"];
$phone = $_POST["phone"];
$password = $_POST["password"];
$email = $_POST["email"];
$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $requete = "INSERT INTO accounts (Email, Password, Phone, ScreenName) VALUES ('$email', '$password','$phone','$username')";
    $connexion->exec($requete);
    echo json_encode("Ok");
} catch (PDOException $e) {
    echo "Échec de connexion à la base de données: " . $e->getMessage();
}
