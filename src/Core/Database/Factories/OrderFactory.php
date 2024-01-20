<?php 

namespace App\Core\Database\Factories;

use App\Core\Database\MySQL;
use App\Models\Order;

class OrderFactory 
{
    private MySQL $db;

    public function __construct()
    {
        $this->db = new MySQL;
    }
    
    public function create(array $data)
    {
        $order = new Order;
        $order->uuid = $data['uuid'];
        $order->productId = $data['product_id'];
        $order->userId = $data['user_id'];
        $order->quantity = $data['quantity'];
        $order->status = $data['status'];

        $this->db->save($order, 'orders');
    }
}