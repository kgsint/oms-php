<?php 

namespace App\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Core\App;
use App\Core\View;
use App\Http\FormRequests\ProductStoreRequest;
use App\Http\FormRequests\ProductUpdateRequest;
use App\Models\Product;

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
        $product->price = (int) $_POST['price'];
        $product->active = (int) isset($_POST['active']);

        // save to products table
        $id = $this->productRepo->save($product);

        // associate with intermediate table (category_product)
        foreach($_POST['category'] as $categoryId) {
            $this->productRepo->associateWithCategory($id, (int) $categoryId);
        }

        return redirect('/products/new');
    }

    public function edit()
    {
        $id = (int) $_GET['id'];

        // abort if not found
        if(! $product = $this->productRepo->find($id)) {
            abort(404);
        };

        return View::make('products.edit', [
            'product' => $product,
            'categories' => $this->categoryRepo->getAll(),
        ]);
    }

    public function update()
    {
        $id = (int) $_POST['id'];

        // abort if not found
        if(! $product = $this->productRepo->find($id)) {
            abort(404);
        };

        // validate
        ProductUpdateRequest::validate($_POST);

        // set product model
        $product->title = $_POST['title'];
        $product->description = $_POST['description'];
        $product->price = (int) $_POST['price'];
        $product->active = (int) isset($_POST['active']);
        // update
        $this->productRepo->save($product);

        // delete records from intermediate/pivot table
        $this->productRepo->disassociateWithCategories($id);

        // then renew
        foreach($_POST['categories'] as $categoryId) {
            $this->productRepo->associateWithCategory($id, (int) $categoryId);
        }

        return redirect('/products');
    }

    public function delete()
    {
        $id = (int) $_POST['id'];

        // if product is'nt found, abort
        if(! $product = $this->productRepo->find($id)) {
            abort(404);
        };

        // delete product
        $this->productRepo->delete($product);
        // delete related records in pivot table
        $this->productRepo->disassociateWithCategories($id);

        return redirect('/products');
    }
}