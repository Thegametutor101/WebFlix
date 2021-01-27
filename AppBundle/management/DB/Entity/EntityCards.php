<?php

require_once (__DIR__."../Connection.php");

class EntityCards
{
    private $connection;

    /**
     * EntityCards constructor.
     */
    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @return array
     */
    function getCards(): array
    {
        $cards = array();
        try {
            $request = "SELECT * FROM cards";
            $result = $this->connection->query($request);
            $cards = $result->fetchAll();

            return $cards;
        }
        catch(PDOException $e) {
            return $cards;
        }
    }

    /**
     * @param int $id
     * @return array
     */
    function getCardByID(int $id): array
    {
        $card = array();
        try {
            $request = "SELECT * FROM cards WHERE ID = '$id'";
            $result = $this->connection->query($request);
            $card = $result->fetch();

            return $card;
        }
        catch(PDOException $e) {
            return $card;
        }
    }

    /**
     * @param bool $favorite
     * @return array
     */
    function getCardByFavorite(bool $favorite): array
    {
        $card = array();
        try {
            $request = "SELECT * FROM cards WHERE Favorite = '$favorite'";
            $result = $this->connection->query($request);
            $card = $result->fetchAll();

            return $card;
        }
        catch(PDOException $e) {
            return $card;
        }
    }
}