<?php 

namespace App\Controllers;

use App\Contracts\ProductRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Core\App;
use App\Core\View;

class HomeController 
{
    private UserRepositoryInterface $userRepo;
    private ProductRepositoryInterface $productRepo;

    public function __construct()
    {
        $this->userRepo = App::resolve(UserRepositoryInterface::class);
        $this->productRepo = App::resolve(ProductRepositoryInterface::class);
    }
    
    public function index(): View
    {
        return View::make('index', [
            'users_count' => $this->userRepo->getCount(),
            'products_count' => $this->productRepo->getCount(),
        ]);
    }
}