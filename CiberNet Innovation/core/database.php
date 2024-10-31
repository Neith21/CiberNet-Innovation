<?php

class Database
{
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . Config::HOST . ";dbname=" . Config::DATABASE,
                Config::USER,
                Config::PASSWORD
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $ex) {
            echo "Connection error: " . $ex->getMessage();
            die();
        }
        return $this->conn;
    }
}

