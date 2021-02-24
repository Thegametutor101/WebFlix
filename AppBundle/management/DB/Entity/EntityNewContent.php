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
            $request = "SELECT * FROM formnouveaucontenu";
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


    /**
     * @param string $type
     * @return array
     */
    function getCardByType(string $type): array
    {
        $card = array();
        try {
            $request = "SELECT * FROM cards WHERE Type = '$type'";
            $result = $this->connection->query($request);
            $card = $result->fetchAll();

            return $card;
        } catch (PDOException $e) {
            return $card;
        }
    }


    /**
     * @return array
     */
    function getGenreCards(): array
    {
        $genres = array();
        try {
            $request = "SELECT Genre FROM cards";
            $result = $this->connection->query($request);
            $genres = $result->fetchAll();

            return $genres;
        } catch (PDOException $e) {
            return $genres;
        }
    }


    /**
     * @param string $genre
     * @return array
     */
    function getCardByGenre(string $genre): array
    {
        $card = array();
        try {
            $request = "SELECT * FROM cards WHERE Genre like '%$genre%'";
            $result = $this->connection->query($request);
            $card = $result->fetchAll();

            return $card;
        } catch (PDOException $e) {
            return $card;
        }
    }

}
