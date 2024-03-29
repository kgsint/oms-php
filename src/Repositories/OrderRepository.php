<?php 

namespace App\Repositories;

use App\Core\App;
use PDOException;
use App\Models\Order;
use App\Core\Database\MySQL;
use App\Core\Database\Database;
use App\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * $db object might change according to database connection|driver (pgsql, sqlite) etc
     * doc block to autocomple methods
     * @var MySQL $db
    */
    private $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function getAll(): array
    {
        return $this->db->rows('orders');
    }

    public function getCount(): int
    {
        return $this->db->totalCount('orders');
    }

    public function getWithProductAndUser($limit = null): array|string
    {
        try {
            $sql = "
                SELECT orders.*, 
                products.title AS product,
                users.name AS username,
                users.email as email
                FROM `orders`
                LEFT JOIN `products` ON orders.product_id = products.id
                LEFT JOIN `users` on orders.user_id = users.id
                ORDER BY created_at, id DESC
            ";

            if($limit) {
                $sql .= " LIMIT {$limit}";
            }

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
        $data = $this->db->findById($id, 'orders');

        $order = new Order;
        $order->id = $data->id;
        $order->uuid = $data->uuid;
        $order->status = $data->status;
        $order->createdAt = mysqlTimestampToDateTime($data->created_at);
        $order->updatedAt = mysqlTimestampToDateTime($data->updated_at);

        return $order;
    }

    public function save(Order $order): int
    {
        return $this->db->save($order, 'orders');
    }

    public function delete(Order $order)
    {
        $this->db->remove($order, 'orders');
    }
}