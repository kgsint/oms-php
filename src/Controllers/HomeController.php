<?php 

namespace App\Controllers;

use App\Contracts\OrderRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Core\App;
use App\Core\View;

class HomeController 
{
    private UserRepositoryInterface $userRepo;
    private ProductRepositoryInterface $productRepo;
    private OrderRepositoryInterface $orderRepo;

    public function __construct()
    {
        $this->userRepo = App::resolve(UserRepositoryInterface::class);
        $this->productRepo = App::resolve(ProductRepositoryInterface::class);
        $this->orderRepo = App::resolve(OrderRepositoryInterface::class);
    }
    
    public function index(): View
    {
        return View::make('index', [
            'users_count' => $this->userRepo->getCount(),
            'products_count' => $this->productRepo->getCount(),
            'orders_count' => $this->orderRepo->getCount(),
            'orders' => $this->orderRepo->getWithProductAndUser(5),
        ]);
    }
}