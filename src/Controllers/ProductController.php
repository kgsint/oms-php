<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class ProductController 
{
    private ProductRepository $productRepo;
    private CategoryRepository $categoryRepo;

    public function __construct()
    {
        $this->productRepo = new ProductRepository(new Database);
        $this->categoryRepo = new CategoryRepository(new Database);
    }

    public function index()
    {
        $products = $this->productRepo->getAll();

        return View::make('products.index', compact('products'));
    }

    public function create(): View
    {
        return View::make('products.create', [
            'categories' => $this->categoryRepo->getAll(),
        ]);
    }
}