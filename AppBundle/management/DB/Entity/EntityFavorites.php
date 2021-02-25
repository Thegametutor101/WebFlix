<?php

require_once (__DIR__."/../Connection.php");

class EntityFavorites
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function getFavorites():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM favorites";
            $result = $this->connection->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

}