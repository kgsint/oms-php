<?php 

namespace App\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Core\App;
use App\Core\Database\Database;
use App\Core\View;
use App\Http\FormRequests\ProductStoreRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class ProductController 
{
    private ProductRepositoryInterface $productRepo;
    private CategoryRepositoryInterface $categoryRepo;

    public function __construct()
    {
        $this->productRepo = App::resolve(ProductRepositoryInterface::class);
        $this->categoryRepo = App::resolve(CategoryRepositoryInterface::class);
    }

    public function index()
    {
        $products = $this->productRepo->getWithCategories();

        // dd($products[0]->categories, true);

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
        $product->active = (int) isset($_POST['active']);

        // save to products table
        $id = $this->productRepo->save($product);

        // associate with intermediate table (category_product)
        foreach($_POST['category'] as $categoryId) {
            $this->productRepo->associateWithCategory($id, (int) $categoryId);
        }

        return redirect('/products/new');
        
    }
}