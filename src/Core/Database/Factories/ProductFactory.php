<?php

namespace App\Core\Database\Factories;

use App\Core\Database\MySQL;
use App\Models\Product;

class ProductFactory
{
    private MySQL $db;

    public function __construct()
    {
        $this->db = new MySQL;
    }

    public function create(array $data)
    {
        $product = new Product;

        // $product = new Product;
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->active = $data['active'];

        $this->db->save($product, 'products');

    }
}