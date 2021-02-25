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
}