<?php 

namespace App\Controllers;

use App\Core\View;

class HomeController 
{
    public function index(): View
    {
        return View::make('index', ['foo' => 'bar']);
    }
}