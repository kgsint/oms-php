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
                SELECT orders.*, 
                products.title AS product,
                users.name AS username,
                users.email as email
                FROM `orders`
                LEFT JOIN `products` ON orders.product_id = products.id
                LEFT JOIN `users` on orders.user_id = users.id
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
        $data = $this->db->findById($id, 'orders');

        $order = new Order;
        $order->id = $data->id;
        $order->uuid = $data->uuid;
        $order->username = $data->username;
        $order->email = $data->email;
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