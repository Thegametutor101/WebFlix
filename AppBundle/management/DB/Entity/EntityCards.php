<?php

require_once (__DIR__."../Connection.php");

class EntityCards
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function getCards():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM cards";
            $result = $this->connection->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
}