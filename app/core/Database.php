<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $dbname = 'KADA';
    private $user = 'root';
    private $pass = ''; // Leave empty for no password
    private $pdo;

    public function connect()
    {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
                $this->pdo = new PDO($dsn, $this->user, $this->pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
