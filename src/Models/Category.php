<?php 

namespace App\Models;

use DateTime;

class Category
{
    public int $id;
    public string $name;
    public string $slug;
    public bool $active;
    public DateTime $createdAt;
    public DateTime $updatedAt;
}