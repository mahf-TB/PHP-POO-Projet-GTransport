<?php
namespace Database;

use PDO;
use PDOException;

class DBConnexion{
    private $dbname;
    private $host;
    private $user;
    private $password;
    private $pdo;

    public function __construct(string $dbname, string $host, string $user, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host}",$this->user,$this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->exec("SET NAMES utf8mb4");
            } catch (PDOException $e) {
                throw new PDOException("Connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}