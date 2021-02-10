<?php

$connexion = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3308", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_POST["req"] == "Get_Videos_Info") {
    get_info_videos($connexion);
}

if ($_POST["req"] == "Get_Video_Info_ID") {
    if (!empty($_POST["id"]))
    {
        $id = $_POST["id"];
        get_info_videos_id($id, $connexion);
    }
}

function get_info_videos($connexion)
{
    try {
        $requete = "select * from cards";
        $res = $connexion->query($requete);
        $lignes = $res->fetchAll();
        echo json_encode($lignes);
    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}

function get_info_videos_id($id, $connexion)
{
    try {
        $requete = "select * from cards where ID = '$id'";
        $res = $connexion->query($requete);
        $lignes = $res->fetchAll();
        echo json_encode($lignes);
    } catch (PDOException $e) {
        echo json_encode("Échec de connexion à la base de données: " . $e->getMessage());
    }
}