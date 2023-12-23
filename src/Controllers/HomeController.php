<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\Database\MySQL;
use App\Core\View;
use App\Models\User;
use App\Repositories\UserRepository;

class HomeController 
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database);
    }
    
    public function index(): View
    {
        return View::make('index', ['user_count' => $this->userRepo->getCount()]);
    }
}