<?php 

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Core\Database\Database;
use App\Models\Product;
use PDOException;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private Database $db,
    ){}

    public function getAll(): array
    {
        return $this->db->rows('products');
    }

    public function getCount(): int
    {
        return $this->db->totalCount('products');
    }

    public function getWithCategories()
    {
        $db = $this->db->connect();
        $sql = "
            SELECT products.*,
                    GROUP_CONCAT(c.name SEPARATOR ',') AS categories 
                    FROM `products` 
                    LEFT JOIN category_product on products.id = category_product.product_id 
                    LEFT JOIN categories c on c.id = category_product.category_id
                    GROUP BY products.id
                ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e) {
            return $e->getMessage();
        }
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

    public function save(Product $product): int
    {
        return $this->db->save($product, 'products');
    }

    public function associateWithCategory($productId, $categoryId): int|string
    {
        try {
            $sql = "INSERT INTO category_product(category_id, product_id) VALUES(:category_id, :product_id)";

            $db = $this->db->connect();

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ":category_id" => $categoryId,
                ':product_id' => $productId,
            ]);

            return (int) $db->lastInsertId();
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function delete(Product $product)
    {
        $this->db->remove($product, 'products');
    }
}