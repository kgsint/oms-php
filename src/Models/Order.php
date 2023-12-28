<?php 

namespace App\Models;

use DateTime;

class Order 
{
    public int $id;
    public string $uuid;
    public string $product;
    public int $total;
    public int $status;
    public DateTime $createdAt;
    public DateTime $updatedAt;
}