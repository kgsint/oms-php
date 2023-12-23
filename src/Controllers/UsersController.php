<?php

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Models\User;
use App\Repositories\UserRepository;
use DateTimeZone;

class UsersController 
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database);
    }

    public function index()
    {
        return View::make('users.index', [
            'users' => $this->userRepo->getAll(),
        ]);
    }

    public function create(): View
    {
        return View::make('users.create');
    }

    public function store()
    { 
        $user = new User;
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->phone = $_POST['phone'];
        $user->address = $_POST['address'];
        $user->roleId = $_POST['role_id'];

        $this->userRepo->save($user);

        return redirect('/users/new');
    }
}