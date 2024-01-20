<?php 

namespace App\Core\Database\Factories;

use App\Models\Category;
use App\Core\Database\MySQL;

class CategoryFactory 
{
    private MySQL $db;

    public function __construct()
    {
        $this->db = new MySQL;
    }
    
    public function create(array $data)
    {
        $category = new Category;
        $category->name = $data['name'];
        $category->slug = convertToSlug($data['name']);
        $category->active = $data['active'];

        $this->db->save($category, 'categories');
    }
}