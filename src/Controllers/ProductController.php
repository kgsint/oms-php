<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Http\FormRequests\ProductStoreRequest;
use App\Models\Product;
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

    public function store()
    {
        // dd($_POST);
        ProductStoreRequest::validate($_POST);

        // product model
        $product = new Product;
        $product->title = $_POST['title'];
        $product->description = $_POST['description'];
        $product->active = (int) isset($_POST['active']) ?? 1;

        // save to products table
        $id = $this->productRepo->save($product);

        // associate with intermediate table (category_product)
        $this->productRepo->associateWithCategory($id, (int) $_POST['category']);

        return redirect('/products/new');
        
    }
}