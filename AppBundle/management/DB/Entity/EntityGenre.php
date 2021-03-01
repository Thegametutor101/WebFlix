<?php

require_once (__DIR__."/../Connection.php");

class EntityGenre
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @return array
     */
    function getGenre():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM genre";
            $result = $this->connection->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

    /**
     * @param $name
     * @return bool
     */
    function checkGenreUsed($name):bool
    {
        try {
            $request = "SELECT COUNT(ID) as found FROM genre WHERE Name = '$name'";
            $result = $this->connection->query($request);
            $genre = $result->fetch();
            if ($genre['found'] > 0) {
                return true;
            } else {
                return false;
            }
        }
        catch(PDOException $e) {
            return false;
        }
    }
}