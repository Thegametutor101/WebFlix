<?php

require_once (__DIR__."../Connection.php");

class ModelAccounts
{
    private $connection;

    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    function addBook(string $email, string $password, string $phone, string $screenName): string
    {
        try
        {
            $request = "INSERT INTO accounts VALUES(:email, :password, :phone, :screenName)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':password', $password);
            $declaration->bindParam(':phone', $phone);
            $declaration->bindParam(':screenName', $screenName);

            $declaration->execute();
            return "ok";
        }
        catch(PDOException $e) {
            return $e;
        }
    }
}