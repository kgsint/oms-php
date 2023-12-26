<?php 

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Core\Database\Database;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private Database $db,
    ){}

    public function getAll(): array
    {
        return $this->db->rows('categories');
    }

    public function search(string $search): array
    {
        return $this->db->search($search, 'categories', ['name', 'slug']);
    }

    public function find(string|int $id): ?Category
    {
        $data =  $this->db->findById($id, 'categories');

        // if not found, return null
        if(! $data) {
            return null;
        }

        $category = new Category;
        $category->id = $data->id;
        $category->name = $data->name;
        $category->slug = $data->slug;
        $category->active = (bool) $data->active;
        $category->createdAt = mysqlTimestampToDateTime($data->created_at);
        $category->updatedAt = mysqlTimestampToDateTime($data->updated_at);

        return $category;
    }

    public function save(Category $category): int
    {
        return $this->db->save($category, 'categories');
    }

    public function delete(Category $category)
    {
        $this->db->remove($category, 'categories');
    }
}