<?php

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\Validator;
use App\Core\View;
use App\Exceptions\ValidationException;
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
        foreach($_POST as $name => $value) {
            if(Validator::required($_POST[$name])) {
                ValidationException::throw("{$name} is required");
            }
        }

        // user model
        $user = new User;
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->phone = $_POST['phone'];
        $user->address = $_POST['address'];
        $user->roleId = $_POST['role_id'];

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