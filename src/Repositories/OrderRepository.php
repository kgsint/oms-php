<?php 

namespace App\Repositories;

use App\Contracts\OrderRepositoryInterface;
use App\Core\App;
use App\Core\Database\Database;
use App\Models\Order;
use PDOException;

class OrderRepository implements OrderRepositoryInterface
{

    public function __construct(
        private Database $db,
    ){}

    public function getAll(): array
    {
        return $this->db->rows('orders');
    }

    public function getCount(): int
    {
        return $this->db->totalCount('orders');
    }

    public function getWithProduct(): array|string
    {
        try {
            $sql = "
                SELECT orders.*, products.title AS product
                FROM `orders`
                LEFT JOIN `products` ON orders.product_id = products.id
            ";

            $db = $this->db->connect();
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function find(string|int $id): Order|null|string
    {
        
    }

    public function save(Order $order): int
    {
        
    }

    public function delete(Order $order)
    {
        
    }
}