<?php

require_once (__DIR__."../Connection.php");

class ModelCards
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function addCard(int $id,
                     string $title,
                     $genre,
                     string $resume,
                     string $image,
                     string $file,
                     $releaseDate,
                     bool $favorite,
                     bool $available,
                     string $classification,
                     string $duration,
                     string $type): string
    {
        try
        {
            $request = "INSERT INTO cards VALUES(:id, 
                            :title, 
                            :genre, 
                            :resume, 
                            :image, 
                            :file, 
                            :releaseDate, 
                            :favorite, 
                            :available, 
                            :classification, 
                            :duration, 
                            :type)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':id', $id);
            $declaration->bindParam(':title', $title);
            $declaration->bindParam(':genre', $genre);
            $declaration->bindParam(':resume', $resume);
            $declaration->bindParam(':image', $image);
            $declaration->bindParam(':file', $file);
            $declaration->bindParam(':releaseDate', $releaseDate);
            $declaration->bindParam(':favorite', $favorite);
            $declaration->bindParam(':available', $available);
            $declaration->bindParam(':classification', $classification);
            $declaration->bindParam(':duration', $duration);
            $declaration->bindParam(':type', $type);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}