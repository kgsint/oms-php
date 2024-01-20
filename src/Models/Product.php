<?php 

namespace App\Models;

use App\Core\Database\Factories\ProductFactory;
use DateTime;

class Product 
{
    public int $id;
    public string $title;
    public string $description;
    public int $price;
    public array $categories;
    public int $active;
    public DateTime $createdAt;
    public DateTime $updatedAt;

    public static function factory(): ProductFactory
    {
        return new ProductFactory;
    }
}