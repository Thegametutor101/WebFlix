<?php

require_once (__DIR__."/../Connection.php");

class ModelAccounts
{
    private $connection;

    /**
     * ModelAccounts constructor.
     */
    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $phone
     * @param string $screenName
     * @param string $profile
     * @param int $admin
     * @return string
     */
    function addAccount(string $email,
                        string $password,
                        string $phone,
                        string $screenName,
                        string $profile,
                        int $admin): string
    {
        try {
            $request = "INSERT INTO accounts VALUES(:email, :password, :phone, :screenName, :profile, :admin)";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':password', $password);
            $declaration->bindParam(':phone', $phone);
            $declaration->bindParam(':screenName', $screenName);
            $declaration->bindParam(':profile', $profile);
            $declaration->bindParam(':admin', $admin);

            $declaration->execute();
            return "ok";
        } catch(PDOException $e) {
            return $e;
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $phone
     * @param string $screenName
     * @return string
     */
    function updateAccount(string $email, string $password, string $phone, string $screenName): string
    {
        try {
            $request = "UPDATE accounts 
                        SET Password = :password, Phone = :phone, ScreenName = :screenName 
                        WHERE Email = :email";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':password', $password);
            $declaration->bindParam(':phone', $phone);
            $declaration->bindParam(':screenName', $screenName);

            $declaration->execute();
            return "ok";
        } catch(PDOException $e) {
            return $e;
        }
    }

    /**
     * @param string $newEmail
     * @param string $oldEmail
     * @return string
     */
    function updateAccountEmail(string $newEmail, string $oldEmail): string
    {
        try {
            $request = "UPDATE accounts 
                        SET Email = :newEmail 
                        WHERE Email = :oldEmail";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':newEmail', $newEmail);
            $declaration->bindParam(':oldEmail', $oldEmail);

            $declaration->execute();
            return "ok";
        } catch(PDOException $e) {
            return $e;
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    function updateAccountPassword(string $email, string $password): string
    {
        try {
            $request = "UPDATE accounts 
                        SET Password = :password
                        WHERE Email = :email";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':password', $password);

            $declaration->execute();
            return "ok";
        } catch(PDOException $e) {
            return $e;
        }
    }

    /**
     * @param string $email
     * @param string $phone
     * @return string
     */
    function updateAccountPhone(string $email, string $phone): string
    {
        try {
            $request = "UPDATE accounts 
                        SET Phone = :phone
                        WHERE Email = :email";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':phone', $phone);

            $declaration->execute();
            return "ok";
        } catch(PDOException $e) {
            return $e;
        }
    }

    /**
     * @param string $email
     * @param string $screenName
     * @return string
     */
    function updateAccountScreenName(string $email, string $screenName): string
    {
        try {
            $request = "UPDATE accounts 
                        SET ScreenName = :screenName
                        WHERE Email = :email";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);
            $declaration->bindParam(':screenName', $screenName);

            $declaration->execute();
            return "ok";
        } catch(PDOException $e) {
            return $e;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    function removeAccountByEmail(string $email): bool
    {
        try {
            $request = "DELETE FROM accounts WHERE Email = :email";

            $declaration = $this->connection->prepare($request);
            $declaration->bindParam(':email', $email);

            $declaration->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}