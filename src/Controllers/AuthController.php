<?php

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\FormRequests\LoginFormRequest;
use App\Repositories\UserRepository;

class AuthController 
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database);
    }

    // login view
    public function loginView()
    {
        return View::make('auth.login');
    }

    public function login()
    {
        $user = $this->userRepo->findByEmail($_POST['email']);

        // validations
        $request = LoginFormRequest::validate($_POST);

        // throw credential errors if email or password incorrect
        if(!$user || !password_verify($_POST['password'], $user->password)) {
            $request->setError('email', 'Please provide the correct credentials')
                                                                            ->throw();
        }

        // login
        $_SESSION['user'] = [
            'id' => $user->id,
        ];
        session_regenerate_id(true);

        return redirect('/');

        // dd($_POST);
    }
}