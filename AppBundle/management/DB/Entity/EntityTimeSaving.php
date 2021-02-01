<?php

require_once (__DIR__."/../Connection.php");

class EntityTimeSaving
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function getTimeSaving():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM timesaving";
            $result = $this->connection->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
}