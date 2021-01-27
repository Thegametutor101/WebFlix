<?php

require_once (__DIR__."../Connection.php");

class ModelTimeSaving
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function addTimeSaving(int $id, int $cardID, int $seriesID, string $email, $timeStamp): string
    {
        try
        {
            $request = "INSERT INTO timesaving VALUES(:id, :cardID, :seriesID, :email, :timestamp)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':id', $id);
            $declaration->bindParam(':cardID', $cardID);
            $declaration->bindParam(':seriesID', $seriesID);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':timestamp', $timeStamp);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}