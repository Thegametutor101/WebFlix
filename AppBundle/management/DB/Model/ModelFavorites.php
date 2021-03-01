<?php

require_once (__DIR__."/../Connection.php");

class ModelFavorites
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }




    function deleteFavorite(string $email, int $cardID): bool
    {
        try {
            $request = "DELETE FROM favorites WHERE Email = :Email and CardID = :CardID";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':Email', $email);
            $declaration->bindParam(':CardID', $cardID);

            $declaration->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    function addFavorite(string $email, int $cardID): string
    {
        try
        {
            $request = "INSERT INTO favorites (Email, CardID) VALUES(:Email, :CardID)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':Email', $email);
            $declaration->bindParam(':CardID', $cardID);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }

    /*
    Vérifier le bind param. Sans le bind param, c'est ok pour l'update
    Avec le bind param, incapable de procéder à l'update. 
    */

    function updateFavorite(string $oldemail, string $email): string
    {
        try
        {
            $request = "UPDATE favorites SET Email = '$email' WHERE Email = '$oldemail'";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':oldEmail', $oldemail);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}