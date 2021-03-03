<?php

require_once (__DIR__."/../Connection.php");
class EntityNewContent
{
    private $connection;

    /**
     * EntityNewContent constructor.
     */
    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @return array
     */
    function getNewContent(): array
    {
        $NewContent = array();
        try {
            $request = "SELECT * FROM formnouveaucontenu where Status='';";
            $result = $this->connection->query($request);
            $NewContent = $result->fetchAll();

            return $NewContent;
        } catch (PDOException $e) {
            return $NewContent;
        }
    }
    function getNewContentApprouve(): array
    {
        $NewContent = array();
        try {
            $request = "SELECT * FROM formnouveaucontenu where Status='Approuve';";
            $result = $this->connection->query($request);
            $NewContent = $result->fetchAll();
            return $NewContent;
        } catch (PDOException $e) {
            return $NewContent;
        }
    }
    /**
     * @param int $id
     * @return array
     */
    function getNewContentByID(int $id): array
    {
        $NewContent = array();
        try {
            $request = "SELECT * FROM formnouveaucontenu WHERE ID = '$id'";
            $result = $this->connection->query($request);
            $NewContent = $result->fetch();

            return $NewContent;
        } catch (PDOException $e) {
            return $NewContent;
        }
    }

    /**
     * @param bool $favorite
     * @return array
     */
    function deleteNewContentById(int $id): array
    {
        $NewContent = array();
        try {
            $request = "Delete FROM formnouveaucontenu WHERE ID = '$id'";
             $this->connection->query($request);

        } catch (PDOException $e) {
            return $NewContent;
        }
    }


}
