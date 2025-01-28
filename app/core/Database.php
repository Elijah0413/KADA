<?php
namespace App\Core;

use PDO;
use PDOException;
use Exception;

class Database
{
    private $host = 'localhost';
    private $dbname = 'kada';
    private $user = 'root';
    private $pass = 'admin123';
    private $pdo;
    private static $instance = null;

    public function connect()
    {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
                $this->pdo = new PDO($dsn, $this->user, $this->pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
                error_log("Database connection successful");
            } catch (PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
                die("Database connection error: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
            error_log("Database connection successful");
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            die("Database connection error: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    public function query($sql)
    {
        try {
            return $this->pdo->query($sql);
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            throw $e;
        }
    }

    // Core database functions used by all models
    public function getConnection() {
        return $this->pdo;
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollBack() {
        return $this->pdo->rollBack();
    }

    public function prepare($query) {
        return $this->pdo->prepare($query);
    }
}
