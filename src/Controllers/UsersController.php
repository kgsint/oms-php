<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Core\Database\Database;
use App\Repositories\UserRepository;
use App\Http\FormRequests\UserStoreRequest;

class UsersController 
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database);
    }

    public function index()
    {
        
        // when search
        if(! empty($_GET['s'])) {
            $users = $this->userRepo->search($_GET['s']);
        }else {
            $users = $this->userRepo->getAll();
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