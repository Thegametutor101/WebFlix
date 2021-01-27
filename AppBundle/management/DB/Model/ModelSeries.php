<?php

require_once (__DIR__."/../Connection.php");

class ModelSeries
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function addSeries(int $id,
                     int $cardID,
                     string $title,
                     string $resume,
                     string $image,
                     string $file,
                     $releaseDate,
                     bool $available,
                     string $duration): string
    {
        try
        {
            $request = "INSERT INTO series VALUES(:id, 
                            :title, 
                            :cardID, 
                            :resume, 
                            :image, 
                            :file, 
                            :releaseDate, 
                            :available, 
                            :duration)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':id', $id);
            $declaration->bindParam(':cardID', $cardID);
            $declaration->bindParam(':title', $title);
            $declaration->bindParam(':resume', $resume);
            $declaration->bindParam(':image', $image);
            $declaration->bindParam(':file', $file);
            $declaration->bindParam(':releaseDate', $releaseDate);
            $declaration->bindParam(':available', $available);
            $declaration->bindParam(':duration', $duration);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}