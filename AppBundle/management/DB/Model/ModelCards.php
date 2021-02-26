<?php

require_once (__DIR__."/../Connection.php");

class ModelCards
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function deletecard(int $id): bool
    {
        try {
            $request = "DELETE FROM cards WHERE ID = :id";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':id', $id);

            $declaration->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    function addCard(string $title,
                     $genre,
                     string $resume,
                     string $image,
                     string $file,
                     $releaseDate,
                     bool $available,
                     string $classification,
                     string $duration): string
    {
        try
        {
            $request = "INSERT INTO cards 
                            (Title, 
                             Genre, 
                             Resume, 
                             Image, 
                             File, 
                             ReleaseDate, 
                             Available, 
                             Classification, 
                             Duration)
                        VALUES(:title, 
                            :genre, 
                            :resume, 
                            :image, 
                            :file, 
                            :releaseDate, 
                            :available, 
                            :classification, 
                            :duration)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':title', $title);
            $declaration->bindParam(':genre', $genre);
            $declaration->bindParam(':resume', $resume);
            $declaration->bindParam(':image', $image);
            $declaration->bindParam(':file', $file);
            $declaration->bindParam(':releaseDate', $releaseDate);
            $declaration->bindParam(':available', $available);
            $declaration->bindParam(':classification', $classification);
            $declaration->bindParam(':duration', $duration);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}