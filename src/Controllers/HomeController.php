<?php 

namespace App\Controllers;

use App\Contracts\ProductRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Core\App;
use App\Core\Database\Database;
use App\Core\Database\MySQL;
use App\Core\View;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

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