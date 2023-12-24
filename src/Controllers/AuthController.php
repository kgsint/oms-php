<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Database\Database;
use App\Repositories\UserRepository;
use App\Http\FormRequests\LoginFormRequest;

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
    }

    public function logout()
    {
        // reset session
        $_SESSION = [];
        unset($_SESSION['user']);

        // remove browser cookie
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', "", time() - 1, $params['path'], $params['domain']);

        return redirect('/login');
    }
}