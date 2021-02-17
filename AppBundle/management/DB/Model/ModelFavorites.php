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
}