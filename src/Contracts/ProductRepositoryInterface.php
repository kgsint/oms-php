<?php 

namespace App\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll(): array;

    public function getCount(): int;

    public function getWithCategories();

    public function find(string|int $id): ?Product;

    /**
     * @return $id of the currently created or updated product record
     */
    public function save(Product $product): int;

    // insert data into intermediate table category_product
    public function associateWithCategory($productId, $categoryId): int|string;

    public function delete(Product $product);
}