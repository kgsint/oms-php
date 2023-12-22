<?php 

namespace App\Core\Database;

use PDO;
use PDOException;

class MySQL 
{
    public function __construct(
        private string $host = "localhost",
        private string $name = "order_ms",
        private string $user = "root",
        private string $password = "",
        private ?PDO $db = null,
    ){}

    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->name}";

            $this->db = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            return $this->db;
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}