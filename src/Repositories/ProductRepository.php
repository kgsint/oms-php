<?php 

namespace App\Repositories;

use PDOException;
use App\Models\Product;
use App\Core\Database\MySQL;
use App\Core\Database\Database;
use App\Contracts\ProductRepositoryInterface;
use App\Core\App;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * $db object might change according to database connection|driver (pgsql, sqlite) etc
     * doc block to autocomple methods
     * @var MySQL $db
    */
    private Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

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
            SELECT p.*,
                    GROUP_CONCAT(c.name SEPARATOR ',') AS categories 
                    FROM `products` AS p 
                    LEFT JOIN category_product AS pivot on p.id = pivot.product_id 
                    LEFT JOIN categories AS c on c.id = pivot.category_id
                    GROUP BY p.id
                ";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function find(string|int $id): Product|null|string
    {
        try {
            $db = $this->db->connect();

            $sql = "
                    SELECT p.*,
                            GROUP_CONCAT(c.name SEPARATOR ',') AS categories
                            from `products` AS p
                        LEFT JOIN `category_product` AS pivot on p.id = pivot.product_id
                        LEFT JOIN `categories` AS c on pivot.category_id = c.id
                        WHERE p.id = :id
                ";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);

            $data = $stmt->fetch();
        }catch(PDOException $e) {
            return $e->getMessage();
        }

        if(! $data->id) {
            return null;
        }

        // if not found, return null
        if(empty($data)) {
            return null;
        }

        $product = new Product;
        $product->id = $data->id;
        $product->title = $data->title;
        $product->description = $data->description;
        $product->price = $data->price;
        $product->categories = explode(',', $data->categories); // string to array
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

    public function disassociateWithCategories(int $productId): int|string
    {
        try {
            $sql = "
                DELETE FROM `category_product` WHERE product_id=:product_id
            ";

            $db = $this->db->connect();
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':product_id' => $productId,
            ]);

            return $stmt->rowCount();
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete(Product $product)
    {
        $this->db->remove($product, 'products');
    }
}