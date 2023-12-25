<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Repositories\ProductRepository;

class ProductController 
{
    private ProductRepository $productRepo;

    public function __construct()
    {
        $this->productRepo = new ProductRepository(new Database);
    }

    public function index()
    {
        $products = $this->productRepo->getAll();

        return View::make('products.index', compact('products'));
    }
}