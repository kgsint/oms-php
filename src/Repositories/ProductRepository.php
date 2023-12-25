<?php 

namespace App\Repositories;

use App\Core\Database\Database;
use App\Models\Category;
use App\Models\Product;

class ProductRepository
{
    public function __construct(
        private Database $db,
    ){}

    public function getAll()
    {
        return $this->db->rows('products');
    }

    public function find(string|int $id): ?Product
    {
        $data =  $this->db->findById($id, 'products');

        // if not found, return null
        if(! $data) {
            return null;
        }

        $product = new Product;
        $product->id = $data->id;
        $product->title = $data->title;
        $product->description = $data->description;
        $product->active = (int) $data->active;
        $product->createdAt = mysqlTimestampToDateTime($data->created_at);
        $product->updatedAt = mysqlTimestampToDateTime($data->updated_at);

        return $product;
    }

    public function save(Product $product)
    {
        return $this->db->save($product, 'products');
    }

    public function delete(Product $product)
    {
        $this->db->remove($product, 'products');
    }
}