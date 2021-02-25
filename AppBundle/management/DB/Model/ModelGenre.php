<?php

require_once (__DIR__."/../Connection.php");

class ModelGenre
{
    private $connection;

    /**
     * ModelGenre constructor.
     */
    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @param string $name
     * @return boolean
     */
    function addGenre(string $name): bool
    {
        try
        {
            $request = "INSERT INTO genre (Name) VALUES(:name)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':name', $name);

            $declaration->execute();
            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }

    /**
     * @param int $id
     * @return boolean
     */
    function removeGenre(int $id): bool
    {
        try
        {
            $request = "DELETE FROM genre WHERE ID = '$id'";

            $this->connection->exec($request);
            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }
}