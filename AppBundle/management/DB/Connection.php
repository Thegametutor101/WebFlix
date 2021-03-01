<?php

class Connection
{
    private $connection;
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=netflix_projet;port=3306,charset=utf8",
                "root",
                "");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}