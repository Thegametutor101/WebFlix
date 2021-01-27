<?php

require_once (__DIR__."../Connection.php");

class EntityAccounts
{
    private $connection;

    /**
     * EntityAccounts constructor.
     */
    public function __construct()
    {
        $constants = new Connection();
        $this->connection = $constants->getConnection();
    }

    /**
     * @return array
     */
    function getAccounts(): array
    {
        $accounts = array();
        try {
            $request = "SELECT * FROM accounts";
            $result = $this->connection->query($request);
            $accounts = $result->fetchAll();

            return $accounts;
        }
        catch(PDOException $e) {
            return $accounts;
        }
    }

    /**
     * @param string $email
     * @return array
     */
    function getAccountByEmail(string $email): array
    {
        $account = array();
        try {
            $request = "SELECT * FROM accounts WHERE Email = '$email'";
            $result = $this->connection->query($request);
            $account = $result->fetch();

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
            $request = "SELECT * FROM accounts WHERE Email = '$email'";
            $result = $this->connection->query($request);
            $account = $result->fetch();

            if (count($account) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return true;
        }
    }
}