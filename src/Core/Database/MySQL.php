<?php 

namespace App\Core\Database;

use PDO;
use PDOException;

class MySQL 
{
    private string $host;
    private string $name;
    private string $user;
    private string $password;
    private ?PDO $db = null;

    public function __construct(){
          $this->host = $_ENV['DB_HOST'];
          $this->name = $_ENV['DB_NAME'];
          $this->user = $_ENV['DB_USER'];
          $this->password = $_ENV['DB_PASSWORD'];
    }

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