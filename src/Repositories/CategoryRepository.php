<?php 

namespace App\Repositories;

use App\Core\Database\Database;

class CategoryRepository
{
    public function __construct(
        private Database $db,
    ){}

    public function getAll()
    {
        return $this->db->rows('categories');
    }
}