<?php 

namespace App\Models;

use DateTime;
use App\Core\Database\Factories\OrderFactory;

class Order 
{
    public int $id;
    public string $uuid;
    public ?string $product; // name of the product from products table
    public ?string $username; // name of the user
    public ?string $email; // email of the user
    public ?int $userId;
    public ?int $productId;
    public int $status;
    public int $quantity;
    public DateTime $createdAt;
    public DateTime $updatedAt;

    public static function factory(): OrderFactory
    {
        return new OrderFactory;
    }
}