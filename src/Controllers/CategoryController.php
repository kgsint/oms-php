<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Repositories\CategoryRepository;

class CategoryController 
{
    private CategoryRepository $categoryRepo;

    public function __construct()
    {
        $this->categoryRepo = new CategoryRepository(new Database);
    }
    
    public function index(): View
    {
        return View::make('categories.index', [
            'categories' => $this->categoryRepo->getAll(),
        ]);
    }

}