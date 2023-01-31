<?php

namespace App;

use PDO;
use PDOException;
use PDOStatement;

class Mysql
{
    private string $host;

    private string $username;

    private string $password;

    private string $database;

    private string $dsn;

    public ?PDO $conn = null;

    public function __construct()
    {
        $params = require __DIR__ . '/../config/mysql.php';

        $this->host = $params['host'];
        $this->username = $params['username'];
        $this->password = $params['password'];
        $this->database = $params['database'];
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8mb4';
    }

    public function connect(): ?PDO
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function run(
        $sql,
        $args = null,
    ): PDOStatement {
        if (!$this->conn) {
            $this->connect();
        }

        $statement = $this->conn->prepare($sql);
        $statement->execute($args);

        return $statement;
    }
}
