<?php 

namespace App\Models;

use DateTime;

class Order 
{
    public int $id;
    public string $uuid;
    public ?string $product; // name of the product from products table
    public ?string $username; // name of the user
    public ?string $email; // email of the user
    public int $status;
    public DateTime $createdAt;
    public DateTime $updatedAt;
}