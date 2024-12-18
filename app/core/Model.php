<?php
namespace App\Core;

use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host=localhost;dbname=kada;charset=utf8", // Update this with your actual DB credentials
                "root", // Your database username
                "",     // Your database password
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}
