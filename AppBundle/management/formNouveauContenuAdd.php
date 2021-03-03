<?php


  $connection = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3306",
    "root",
    "");
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



//if(!empty($_POST["Titre"]))
//  $Titre = $_POST["Titre"];
try {

  $request = "INSERT INTO formnouveaucontenu(Titre, Platform, TypeVideo, LienDirect, DateSoumis) VALUES(:titre, :platform, :typeVideo, :lien,CURRENT_DATE())";
  $declaration = $connection->prepare($request);
  $declaration->bindParam(':titre', $_POST["titre"]);
  $declaration->bindParam(':platform', $_POST["platform"]);
  $declaration->bindParam(':typeVideo', $_POST["typeVideo"]);
  $declaration->bindParam(':lien', $_POST["lien"]);

  $declaration->execute();

  echo json_encode(array("item"=>"ok"));
} catch(PDOException $e) {
  echo $e;
}

