<?php

namespace App\Controllers;

use App\Contracts\UserRepositoryInterface;
use App\Core\App;
use App\Core\Container;
use App\Core\View;
use App\Models\User;
use App\Core\Database\Database;
use App\Core\Router;
use App\Repositories\UserRepository;
use App\Http\FormRequests\UserStoreRequest;

class UsersController 
{
    private UserRepositoryInterface $userRepo;

    public function __construct()
    {
        $this->userRepo = App::resolve(UserRepositoryInterface::class);
    }

    public function index(): View
    {
        $users = $this->userRepo->getAll();
        
        // when search
        if(! empty($_GET['s'])) {
            $users = $this->userRepo->search($_GET['s']);
        }


        return View::make('users.index', compact('users'));
    }

    public function create(): View
    {
        return View::make('users.create');
    }

    public function store()
    { 
        // validation
        UserStoreRequest::validate($_POST);

        // user model
        $user = new User;
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->phone = $_POST['phone'];
        $user->address = $_POST['address'];
        $user->roleId = $_POST['role'];


        // save/create record
        $this->userRepo->save($user);

        return redirect('/users/new');
    }

    public function destroy()
    {
        // if no user found, return back with 404 status code
        if(! $user = $this->userRepo->find($_POST['id'])) {
            http_response_code(404);
            return redirect('/users');
        }

        // delete
        $this->userRepo->delete($user);

        return redirect('/users');
    }
}