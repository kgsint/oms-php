<?php

namespace App\Controllers;

use App\Core\View;

class LoginController 
{
    public function view()
    {
        return View::make('auth.login');
    }
}