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

    function getSpecificTimeSaving(int $cardID, string $email)
    {
        $lines = array();
        try {
            $request = "SELECT TimeStamp as TIME FROM timesaving where CardID = '$cardID' and Email = '$email'";
            $result = $this->connection->query($request);
            $lines = $result->fetch();

            return $lines["TIME"];
        }
        catch(PDOException $e) {
            return $lines;
        }
    }


    function TimeSavingAlreadyExist(int $cardID, string $email)
    {
        $lines = array();
        try {
            $request = "SELECT count(*) as NOMBRE from timesaving where CardID = '$cardID' and Email = '$email'";
            $result = $this->connection->query($request);
            $lines = $result->fetch();

            return $lines["NOMBRE"];
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

}