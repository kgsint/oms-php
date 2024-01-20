<?php 

namespace App\Models;

use App\Core\Database\Factories\CategoryFactory;
use DateTime;

class Category
{
    public int $id;
    public string $name;
    public string $slug;
    public int $active;
    public DateTime $createdAt;
    public DateTime $updatedAt;

    public static function factory(): CategoryFactory
    {
        return new CategoryFactory;
    }
}