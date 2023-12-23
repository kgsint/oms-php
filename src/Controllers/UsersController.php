<?php

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Repositories\UserRepository;

class UsersController 
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database);
    }

    public function index()
    {
        return View::make('users/index', [
            'users' => $this->userRepo->getAll(),
        ]);
    }
}