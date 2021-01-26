<?php

require_once (__DIR__."../Connection.php");

class EntitySeries
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function getSeries():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM series";
            $result = $this->connection->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
}