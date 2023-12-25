<?php 

namespace App\Controllers;

use App\Core\View;

class CategoryController 
{
    public function index(): View
    {
        return View::make('categories.index');
    }
}