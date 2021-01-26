<?php

require_once (__DIR__."../Connection.php");

class EntityAccounts
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function getAccounts():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM accounts";
            $result = $this->connection->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
}