<?php

require_once (__DIR__."/../Connection.php");

class ModelTimeSaving
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function addTimeSaving(int $cardID, string $email, string $timeStamp): string
    {
        try
        {
            $request = "INSERT INTO timesaving (CardID, Email, TimeStamp) VALUES(:cardID, :email, :timestamp)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':cardID', $cardID);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':timestamp', $timeStamp);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }


    function updateTimeSaving(int $cardID, string $email, string $timeStamp): string
    {
        try
        {
            $request = "UPDATE timesaving set TimeStamp = :timestamp where CardID = :cardID and Email = :email";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':cardID', $cardID);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':timestamp', $timeStamp);

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
    
    function updateTimeSavingWhenEmailChange(string $email, string $oldemail): string
    {
        try
        {
            $request = "UPDATE timesaving set Email = '$email' where Email = '$oldemail'";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':oldemail', $oldemail);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }

}