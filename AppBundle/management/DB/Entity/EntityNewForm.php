<?php

require_once (__DIR__."/../Connection.php");

class EntityNewForm
{
    private $connection;

    /**
     * EntityNewForm constructor.
     */
    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @return array
     */
    function getNewForms(): array
    {
        $NewForms = array();
        try {
            $request = "SELECT * FROM NewForms";
            $result = $this->connection->query($request);
            $NewForms = $result->fetchAll();

            return $NewForms;
        }
        catch(PDOException $e) {
            return $NewForms;
        }
    }

    /**
     * @param string $email
     * @return array
     */
    function getFirstForm(): array
    {
        $NewForms = array();
        try {
            $request = "SELECT top 1 FROM NewForms ";
            $result = $this->connection->query($request);
            $account = $result->fetch();
            if (empty($account))
                return array();
            else
            return $account;
        } catch (PDOException $e) {
            return $account;
        }
    }

    /**
     * @param string $phone
     * @return array
     */
    function getAccountByPhone(string $phone): array
    {
        $account = array();
        try {
            $request = "SELECT * FROM accounts WHERE Phone like '$phone'";
            $result = $this->connection->query($request);
            $account = $result->fetch();

            return $account;
        } catch (PDOException $e) {
            return $account;
        }
    }

    /**
     * @param string $screenName
     * @return array
     */
    function getAccountByScreenName(string $screenName): array
    {
        $account = array();
        try {
            $request = "SELECT * FROM accounts WHERE ScreenName = '$screenName'";
            $result = $this->connection->query($request);
            $account = $result->fetch();

            return $account;
        } catch (PDOException $e) {
            return $account;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    function checkAccountEmailUsed(string $email): bool
    {
        try {
            $request = "SELECT COUNT(Password) FROM accounts WHERE Email = '$email'";
            $result = $this->connection->query($request);
            $account = $result->fetch();

            if ($account !== 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}