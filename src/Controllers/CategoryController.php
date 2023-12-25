<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;

class CategoryController 
{
    private CategoryRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new CategoryRepository(new Database);
    }
    
    public function index(): View
    {
        return View::make('categories.index', [
            'categories' => $this->userRepo->getAll(),
        ]);
    }
}