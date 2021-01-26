<?php

require_once (__DIR__."../Connection.php");

class ModelFavorites
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function addFavorite(int $id, string $email, int $cardID): string
    {
        try
        {
            $request = "INSERT INTO favorites VALUES(:id, :email, :cardID)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':id', $id);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':cardID', $cardID);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}