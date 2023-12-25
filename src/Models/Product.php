<?php 

namespace App\Models;

use DateTime;

class Product 
{
    public int $id;
    public string $title;
    public string $description;
    public int $active;
    public DateTime $createdAt;
    public DateTime $updatedAt;
}